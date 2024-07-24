<?php

use App\Http\Controllers\EditPaste;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\CustomRegistrationController;
use App\Http\Controllers\PasteController;
use App\Http\Controllers\ArchivePastesController;
use App\Http\Controllers\ReportController;
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


Route::get('/',[PasteController::class,'index']) -> name('home');
Route::post('/', [PasteController::class, 'store'])->name('store');

Route::post('logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::get('login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [CustomLoginController::class, 'login'])->name('auth');

Route::get('/register', function () {return view('registration');});
Route::post('/register', [CustomRegistrationController::class, 'register'])->name('register');

Route::get('/archive', [ArchivePastesController::class, 'index'])->name('archive');

Route::get('paste/{short_url}', [ArchivePastesController::class, 'show'])->name('user_paste');

Route::get('report/{short_url}',[ReportController::class, 'index'])->name('report');
Route::post('report/{short_url}',[ReportController::class, 'send_report'])->name('send_report');


Route::get('/mypaste', [ArchivePastesController::class, 'personal_pastes'])->name('personal_pastes');
Route::get('/mypaste/{short_url}', [ArchivePastesController::class, 'personal_paste'])->name('personal_paste');

// Показать форму редактирования пасты
Route::get('/paste/{id}/edit', [EditPaste::class, 'edit'])->name('paste.edit')->middleware('auth');

// Обновить пасту
Route::put('/paste/{id}', [EditPaste::class, 'update'])->name('paste.update')->middleware('auth');

Route::get('/search', [SearchController::class, 'search'])->name('search');

// Route::get('/user__paste', function () {
//     return view('user__paste');
// });

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
