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

Route::get('/', function () { return view('welcome'); });

//Atasak

Route::get('/atasak', [AtasaController::class, 'index'])->name('atasak');

Route::post('/atasak', [AtasaController::class, 'store'])->name('atasak');

Route::get('/atasak/{id}', [AtasaController::class, 'show'])->name('atasa-edit');

Route::patch('/atasak/{id}', [AtasaController::class, 'update'])->name('atasa-update');

Route::delete('/atasak/{id}', [AtasaController::class, 'destroy'])->name('atasa-destroy');


//Erabiltzaileak

Route::get('/erabiltzaileak', function () { return view('erabiltzaileak.index'); });






Route::get('/proba', function () {
    return view('proba');
});

Route::get('/kaixo', function () {
    return "Egunon!";
});
