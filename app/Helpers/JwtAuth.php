<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\User;

class JwtAuth{
    public $key;

    public function __construct(){
        $this->key = 'esta-es-mi-clave-secreta-36112457';
    }

    public  function signup($email, $password, $getToken=null) {
      $user = User::where(
            array(  'email' => $email,
                    'password' => $password
                ))->first();

    // ---------------------- flag
        $signup = false;
        if(is_object($user)){
            $signup = true;
        }
    // ------------------------------

        if($signup){
            // Generar el token y devolverlo
            $token =array(
                'sub' => $user -> id,
                'name' => $user -> name,
                'email'=> $user -> email,
                'lat' => time(), //cuando se creó el token
                'expo' =>time() + (7 * 24 * 60 *60) //cuando va a expirar (1 semana)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256'); //cifrado, HS256 algoritmo de decodificación
            $decoded = JWT::decode($jwt, $this->key, array('HS256')); //decodificación del token

            if(!is_null($getToken)){
                return $jwt;
            }else{
                return $decoded;
            }
        }else {
            // Devolver un error
            return array('status' => 'error', 'message' => 'Login falló!');
        }
    }
    //metodo para manipular el objeto que se obtiene mediante el token 
    public function checkToken($jwt, $getIdentity = false){
        $auth =false;
        // decode del token
        try{
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }

        // Comprobar si existen los datos
        if(is_object($decoded)&& isset($decoded ->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        //Devolver el objeto del usuario identificado
        if($getIdentity){
            return $decoded;
        }

        return $auth;
    }
}