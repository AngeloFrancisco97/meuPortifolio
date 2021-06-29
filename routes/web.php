<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('app.inicio');
})->name('inicio');

Route::get('/portifolio', function () {
    return view('app.portifolio');
})->name('portifolio');


Route::middleware('auth')->get('/projeto_admin', function () {
    return view('app.projetoAdmin');
})->name('projeto_admin');

Route::middleware('auth')->get('/perfil', function () {
    return view('app.perfil');
})->name('perfil');

Route::middleware('auth')->get('/habilidade', function () {
    return view('app.habilidades');
})->name('habilidade');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




