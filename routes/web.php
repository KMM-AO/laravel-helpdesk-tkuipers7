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

Route::get('/greeting', function () {
    return '<h1>Hello World</h1>';
});

Route::get('/dit/is/een/test', function () {
    return view('test.opdracht3b');
});

Route::view('/dit/is/nog/een/test','test.opdracht3b');

Route::get('test/parameter/{id}', function ($id) {
    return view('test.opdracht3d')->with('param', $id);
});
