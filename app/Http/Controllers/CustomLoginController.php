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

        $messages = [
            'email.required' => 'Поле email обязательно для заполнения.',
            'email.email' => 'Некорректный ввод email. Пример: example@mail.com',
            'password.required' => 'Поле пароля обязательно для заполнения.',
        ];

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->banned == 1) {
                Auth::logout();
                return back()->withErrors([
                    'credentials' => 'Ваш профиль заблокирован.',
                ])->withInput();
            }

            return redirect('/');
        }

        return back()->withErrors([
            'credentials' => 'Неверные учетные данные.',
        ])->withInput();
    }
}
