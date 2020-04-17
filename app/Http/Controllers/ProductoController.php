<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JwtAuth;

// Para la descarga de pdf
use Barryvdh\DomPDF\Facade as PDF;

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
                'titulo' => 'required|min:5',
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
            $producto->imagenProducto = $params->imagenProducto;
            $producto->disponible = $params->disponible;
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

    public function download()
    {
        $data = [
            'titulo' => 'Styde.net'
        ];

        $pdf = PDF::loadView('pdf', $data);

        return $pdf->download('archivo.pdf');
    }

}
