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




Route::get('/issue', function () {
    return view('issue');
});

Route::get('/', function () {
    return view('index');
});

Route::post('/', function () {
    return view('index');
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