<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;

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
    return view('welcome');
});

/*
Route::get('/series', function () {
    echo 'olá, mundo!';
});
*/

/*
// ROTAS SEM GRUPO
Route::get('/series', [SeriesController::class, 'index']);
Route::get('/series/criar', [SeriesController::class, 'create']);
Route::post('/series/salvar', [SeriesController::class, 'store']);
*/

/*
// ROTAS EM GRUPO DE CONTROLLERS
Route::controller(SeriesController::class)->group(function(){
    Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
    Route::get('/series/create', [SeriesController::class, 'create'])->name('series.create');
    Route::post('/series/salvar', [SeriesController::class, 'store'])->name('series.store');
});
*/

// OU RESOURCE
Route::resource('/series',SeriesController::class);