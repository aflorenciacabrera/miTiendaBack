<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //
    public function crear(Request $request){
        echo "alta de producto"; die();

    }

    public function index(){
        echo "ver productos"; die();
    }
}
