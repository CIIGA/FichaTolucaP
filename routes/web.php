<?php

use App\Http\Controllers\FichaController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
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

Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::post('/imagenes', [ImageController::class, 'index'])->name('formImg');


Route::get('/buscar', [IndexController::class, 'buscar'])->name('buscar');
//formulario
Route::get('/formulario', [FichaController::class, 'index'])->name('form');
//guardar datos ficha
Route::post('/registro', [FichaController::class, 'store'])->name('store');
//agregar vca
Route::get('/add_vca',  [FichaController::class, 'add_vca'])->name('add_vca');
//cargar tabla_vca
Route::get('/tabla_vca/{clave}',  [FichaController::class, 'tabla_vca'])->name('tabla_vca');
//cargar tabla_vca
Route::get('/delete_id_vca',  [FichaController::class, 'delete_id_vca'])->name('delete_id_vca');
//pdf ficha
Route::get('/ficha/{clavec}/{id_documento}/{id_usuario}', [FichaController::class, 'ficha'])->name('ficha');
//view Fichas del dia
Route::post('/fichas-del-dia', [FichaController::class, 'viewFichasNow'])->name('viewFichas');
//view Fichas all
Route::get('/fichas-generadas/{id_usuario}', [FichaController::class, 'viewFichasall'])->name('viewFichasall');
//modal edit vca
Route::get('/modal_edit_vca/{id}', [FichaController::class, 'modal_edit_vca'])->name('modal_edit_vca');
//editar vca
Route::get('/edit_vca',  [FichaController::class, 'edit_vca'])->name('edit_vca');
