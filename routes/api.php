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

Route::get('/user', [ApiController::class, 'index']);
Route::get('/pastes', [ApiController::class, 'GetPasteList']);
Route::get('/paste/{short_url}', [ApiController::class, 'getPaste']);
Route::delete('delete/paste/{short_url}', [ApiController::class, 'deletePaste']);
Route::post('/ban-user/{id}', [ApiController::class, 'banUser']);
Route::get('/complaints', [ApiController::class, 'GetComplaintList']);
Route::get('/user/{id}', [ApiController::class, 'getUser']);
Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);
