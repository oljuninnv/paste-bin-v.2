<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Illuminate\Support\Str;

class CustomRegistrationController extends Controller
{
    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'Поле имени пользователя обязательно для заполнения.',
            'email.required' => 'Поле email обязательно для заполнения.',
            'email.email' => 'Некорректный ввод email. Пример: example@mail.com',
            'password.required' => 'Поле пароля обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать минимум 8 символов.',
        ];

        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ], $messages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Хеширование пароля            
            'remember_token' => Str::random(50),
            'banned' => 0
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
