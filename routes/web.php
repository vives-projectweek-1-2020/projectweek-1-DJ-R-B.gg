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




Route::get('/wiskunde', function () {
    return view('wiskunde');
});

Route::get('/talen', function () {
    return view('talen');
});

Route::get('/geschiedenis', function () {
    return view('geschiedenis');
});

Route::get('/oefeningen', function () {
    return view('oefeningen');
});

Route::get('/file', function () {
    return view('fileUpload');
});
 
Route::post('/file', function () {
    return view('fileUpload');
});
 
Route::post('/file_upload', function () {
    return view('fileUpload');

});

?>