<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ProductoController extends Controller
{
    //
    public function crear(Request $request){
        echo "alta de producto"; die();

    }

    public function index(){
        echo "ver productos"; die();
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
