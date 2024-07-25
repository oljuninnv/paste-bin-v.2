<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class CustomRegistrationController extends Controller
{
    public function register(Request $request)
    {
        // Кастомные сообщения валидации
        $messages = [
            'name.required' => 'Поле имени пользователя обязательно для заполнения.',
            'email.required' => 'Поле email обязательно для заполнения.',
            'email.email' => 'Некорректный ввод email. Пример: example@mail.com',
            'password.required' => 'Поле пароля обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать минимум 8 символов.',
        ];

        // Валидация данных регистрации
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ], $messages);

        // Создание нового пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Хеширование пароля
            'banned' => 0
        ]);

        // Аутентификация нового пользователя
        Auth::login($user);

        // Перенаправление на главную страницу после успешной регистрации
        return redirect('/');
    }
}
