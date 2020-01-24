<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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
