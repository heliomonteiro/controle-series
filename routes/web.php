<?php

use App\Http\Controllers\SeasonsController;
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
    return to_route('series.index');
});

Route::resource('/series',SeriesController::class)
    ->except('show');
    //->only(['index','create','store','destroy','edit','update']);

Route::get('/series/{series}/seasons',[SeasonsController::class, 'index'])->name('seasons.index');