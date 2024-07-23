<?php

use Illuminate\Support\Facades\Route;

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
    return view('paste');
});
Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('registration');
});

Route::get('/archive', function () {
    return view('pastes');
});
Route::get('/mypaste', function () {
    return view('mypaste');
});
Route::get('/user__paste', function () {
    return view('user__paste');
});

Route::get('/user__paste/report', function () {
    return view('report');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
