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
    return view('welcome');
});

// opdarcht 3a
Route::get('/greeting', function () {
    return '<h1>Hello World</h1>';
});

//opdracht 3b
Route::get('/dit/is/een/test', function () {
    return view('test.opdracht3b');
});

//opdracht 3c
Route::view('/dit/is/nog/een/test','test.opdracht3b');

// opdracht 3d
Route::get('test/parameter/{id}', function ($id) {
    return view('test.opdracht3d')->with('param', $id);
});

// opdracht 3e
Route::get('test/integer/{id}', function ($id) {
    return view('test.opdracht3d')->with('param', $id);
})->where('id','[1-9][0-9]*');

//opdacht 3f
Route::get('/test/name/1', function () {
   return view('test.opdracht3f1') ;
})->name('3f1');
Route::get('/test/name/2', function () {
   return view('test.opdracht3f2') ;
})->name('3f2');

