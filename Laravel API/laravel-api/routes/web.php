<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article; // Import the Article class
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
Route::get('articles', function(){
    return Article::all();
});

Route::get('articles/{id}', function($id){
    return Article::find($id);
});

Route::post('articles', function(Request $request){
    return Article::create($request->all());
});

Route::put('articles/{id}', function(Request $request, $id){
    $article = Article::findOrFail($id);
    $article->update($request->all());

    return $article;
});

Route::delete('articles/{id}', function($id){
    Article::find($id)->delete();

    return 204;
});


Route::get('/', function () {
    return view('welcome');
});
