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

// Главная страница с формой
Route::get('/',[PasteController::class,'index']) -> name('home');
Route::post('/', [PasteController::class, 'store'])->name('store');

// Выход из аккаунта
Route::post('logout', [CustomLoginController::class, 'logout'])->name('logout');

// Страница авторизации пользователя
Route::get('login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [CustomLoginController::class, 'login'])->name('auth');

// Страница регистрации пользователя
Route::get('/register', function () {return view('registration');});
Route::post('/register', [CustomRegistrationController::class, 'register'])->name('register');

// Страница со списком паст
Route::get('/archive', [ArchivePastesController::class, 'index'])->name('archive');

// Страница с пастой выбранного пользователя
Route::get('paste/{short_url}', [ArchivePastesController::class, 'show'])->name('user_paste');

// Страница жалоб на пасту
Route::get('report/{short_url}',[ReportController::class, 'index'])->name('report');
Route::post('report/{short_url}',[ReportController::class, 'send_report'])->name('send_report');

// Страница со списком паст пользователя
Route::get('/mypaste', [ArchivePastesController::class, 'personal_pastes'])->name('personal_pastes');

// Страница вывода выбранной пасты
Route::get('/mypaste/{short_url}', [ArchivePastesController::class, 'personal_paste'])->name('personal_paste');

// Форма редактирования пасты
Route::get('/paste/{id}/edit', [EditPaste::class, 'edit'])->name('paste.edit')->middleware('auth');

// Обновление пассты
Route::put('/paste/{id}', [EditPaste::class, 'update'])->name('paste.update')->middleware('auth');

// Форма поиска
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Админ панель
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
