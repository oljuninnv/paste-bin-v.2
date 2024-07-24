<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CustomLoginController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        // Возвращаемся на предыдущую страницу
        return redirect()->back();
    }

    public function showLoginForm()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        // Кастомные сообщения валидации
        $messages = [
            'email.required' => 'Поле email обязательно для заполнения.',
            'email.email' => 'Некорректный ввод email. Пример: example@mail.com',
            'password.required' => 'Поле пароля обязательно для заполнения.',
        ];

        // Валидация данных входа с кастомными сообщениями
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        // Если валидация прошла успешно, пытаемся аутентифицировать пользователя
        if (Auth::attempt($request->only('email', 'password'))) {
            // Аутентификация успешна, перенаправляем на главную страницу
            return redirect('/');
        }

        // Если аутентификация не удалась, вернуть на форму входа с ошибкой
        return back()->withErrors([
            'credentials' => 'Неверные учетные данные.',
        ])->withInput();
    }
}
