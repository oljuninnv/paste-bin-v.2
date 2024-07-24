<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\CustomRegistrationController;
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

Route::post('logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::get('login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [CustomLoginController::class, 'login'])->name('auth');

Route::get('/register', function () {return view('registration');});
Route::post('/register', [CustomRegistrationController::class, 'register'])->name('register');

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
