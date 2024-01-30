<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layout.template');
});


/*------------------------
    DEFINIR MÉTODOS GET 
--------------------------*/

Route::get('/usuario', [UsuarioController::class, 'index']);

Route::get('/usuario/buscar', [UsuarioController::class, 'buscar']);

Route::get('/usuario/registrar', [UsuarioController::class, 'registrar']);

Route::get('/usuario/actualizar', [UsuarioController::class, 'actualizar']);


/*------------------------
    DEFINIR MÉTODOS POST 
--------------------------*/

Route::post('/usuario/buscar', [UsuarioController::class, 'buscar']);

Route::post('/usuario/registrar', [UsuarioController::class, 'registrar']);

Route::post('/usuario/actualizar', [UsuarioController::class, 'actualizar']);

Route::post('/usuario/eliminar', [UsuarioController::class, 'eliminar']);