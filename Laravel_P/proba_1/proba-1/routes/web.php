<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtasaController;
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

Route::get('/atasak', function () {
    return view('atasak.index');
});

Route::post('atasak', [AtasaController::class, 'store'])->name('atasak');

Route::get('/proba', function () {
    return view('proba');
});

Route::get('/kaixo', function () {
    return "Egunon!";
});
