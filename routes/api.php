<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Получение списка пользователй
Route::get('/user', [ApiController::class, 'index']);

// Получение списка паст
Route::get('/pastes', [ApiController::class, 'GetPasteList']);

// Получение конкретной пасты 
Route::get('/paste/{short_url}', [ApiController::class, 'getPaste']);

// Удаление конкретной пасты 
Route::delete('delete/paste/{short_url}', [ApiController::class, 'deletePaste']);

// Добавление в бан пользователя
Route::post('/ban-user/{id}', [ApiController::class, 'banUser']);

// Получение списка жалоб
Route::get('/complaints', [ApiController::class, 'GetComplaintList']);

// Получение определённого пользователя
Route::get('/user/{id}', [ApiController::class, 'getUser']);

// Регистрация пользователя
Route::post('/register', [ApiController::class, 'register']);

// Вход пользователя
Route::post('/login', [ApiController::class, 'login']);
