<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('api/producto','ProductoController@index');

Route::group(['middleware' => ['cors']], function () {    
    
});

    // Rutas a las que se permitirá acceso
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');

    // Rutas de Producto
    Route::get('producto', 'ProductoController@index');
    Route::post('/producto/crear', 'ProductoController@crear');
    Route::get('producto/galeria', 'ProductoController@galeria');
    Route::get('/producto/imagenes', 'ProductoController@imagenes');
   