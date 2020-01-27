<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    //Registro por API
    public function register(Request $request){
        //Recoger post que llega
        $json = $request->input('json', null);
        //Decodificacion del json a un objeto para usarlo en php
        $param = json_decode($json);

        //variables
        $name
        $email
        $rol
        $password

    }

    //Login por API
    public function login(Request $request){
        //Instancia del Objeto
        $jwtAuth = new JwtAuth();

        //Recibir el POST
        $json = $request->input('json', null);
        //decodificar el json y convertir en un objeto para manejarlo en php
        $param = json_decode($json);

        //comprobaciones
        //El json no sea null y exista la propiedad email dentro de param si es true se asigna el valor en caso de flase es null
        $email = (!is_null($json) && isset($param->email)) ? $param->email: null; 
        $password = (!is_null($json) && isset($param->password)) ? $param->password: null;
        $getToken = (!is_null($json) && isset($param->getToken)) ? $param->getToken: true;
        
        //cifrar la password
        $pwd = hash('sha256', $password); //'sha256 algoritmo de cifrado
        
        //Comprobacion
        if(!is_null($email) && !is_null($password)){
            $signup = $jwtAuth->signup($email, $pwd);
            return response()->json($signup, 200);
        }else{
            return response()->json("error", 400);
            //   echo "ver productos"; die();
        }
    }

    
}
