<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Barryvdh\DomPDF\PDF;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get("/storage/{filePath}", "FileController@fileStorageServe")->where(["filePath" => ".*"]);


// Route::post('api/producto','ProductoController@index');

// Route::resource('producto', 'ProductoController');

// Route::post('api/login', 'Auth\LoginController@login');


// Route::group(['middleware' => ['cors']], function () {
//     //Rutas a las que se permitirá acceso

//     Route::post('api/login', 'UserController@login');
//     Route::post('api/register', 'UserController@register');
// });
