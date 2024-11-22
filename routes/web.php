<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

//REDIRECCIONAMIENTO A LA PÁGINA PRINCIPAL DE LA PLATAFORMA ACALDERON 03/09/2024
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//REDIRECCIONAMIENTO A LA PÁGINA DE REPOSITORIOS DE LA PLATAFORMA ACALDERON 03/09/2024
Route::get('/repositorio', [App\Http\Controllers\HomeController::class, 'repositorio'])->name('repositorio');

//REDIRECCIONAMIENTO A LA PÁGINA CAMBIO DE CONTRASEÑA DE LA PLATAFORMA ACALDERON 03/09/2024
Route::get('/contrasena', [App\Http\Controllers\HomeController::class, 'contrasena'])->name('contrasena');

//REDIRECCIONAMIENTO A LA PÁGINA DE PERFILES DE LA PLATAFORMA ACALDERON 03/09/2024
Route::get('/perfiles', [App\Http\Controllers\HomeController::class, 'perfiles'])->name('perfiles');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
