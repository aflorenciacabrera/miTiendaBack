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

    public function crear(request $request)
    {
        $hash = $request->header('Authorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if($checkToken){

            $user = $jwtAuth->checkToken($hash, true);
            $producto = new producto();
            $producto->user_id = $user->sub;
            $producto->titulo = $request->titulo;
            $producto->categoria = $request->categoria;
            $producto->precio = $request->precio;
            $producto->descripcion = $request->descripcion;
            // $producto->imagenProducto = $request->imagenProducto;
            $producto->disponible = $request->disponible;

            if($request->imagenProducto)
            {
                $path = $request->imagenProducto->store('images');
                $producto->imagenProducto = $path;
            }
            
            // return $request;
            $producto->save();
            
            $data = array(
                'producto' => $producto->toJson(),
                'status' => 'success',
                'code' => 200,
            );
            
        }
        else
        {
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
