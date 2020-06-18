<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

use App\producto;
use PhpParser\Node\Stmt\TryCatch;

class ProductoController extends Controller
{
    //
    // public function crear(Request $request){
    //     echo "alta de producto"; die();
    // }
   
    public function index(Request $request){
        $hash = $request->header('Authorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if($checkToken){
            echo "Index de  productoController Autenticado"; die();
        }else{
            echo "No Autentucado->Index de  productoController"; die();
        };
        
    }

    public function crear(Request $request){
        // return response($request);
        $hash = $request->header('Authorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if($checkToken){

        // Recojer datos por post
        $json = $request->input('json', null);
        // print_r($json);
        //  return response($json);

        $params = json_decode($json);
        $params_array = json_decode($json, true);
        //  print_r($params_array);
        //  return response($params_array);

        // Usuario identificado
         $user = $jwtAuth->checkToken($hash, true);
        
        // Validación
        $request->merge($params_array);
        Try{
            $validate = $this->validate($request,[
                'titulo' => 'required',
                'categoria' => 'required',
                'precio' => 'required',
                'descripcion' => 'required',
                'imagenProducto' => '',
                'disponible' => 'required',
            ]);
            //  var_dump($validate); die();
        }catch(\Illuminate\Validation\ValidationException $e){
            return $e->getResponse();
        }
        
        // $errors = $validate->errors();
        // if($errors){
        //     return $errors->toJson();
        // }

        // Guardar el producto
            $producto = new producto();
            $producto->user_id = $user->sub;
            $producto->titulo = $params->titulo;
            $producto->categoria = $params->categoria;
            $producto->precio = $params->precio;
            $producto->descripcion = $params->descripcion;
            // $producto->imagenProducto = $params->imagenProducto;
            $producto->disponible = $params->disponible;

            $image = $request->file('image');
            if($image){
                $image_path = $producto->imagenProducto->getClientOriginalName();
                Storage::disk('images')->put($image_path, File::get($image));
                $producto->imagenProducto = $image_path;
            }
            $producto->save();

            $data = array(
                'producto' => $producto,
                'status' => 'success',
                'code' => 200,
            );

        }else{
           // Devolver Error
           $data = array(
            'message' => 'Login incorrecto',
            'status' => 'error',
            'code' => 300,
            );
        };
        return response()->json($data, 200);
 
     } 

}
