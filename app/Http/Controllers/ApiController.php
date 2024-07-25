<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Paste;
use App\Models\Complaints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = $user->createToken('User Token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' =>'Registration successful'
        ],201);
    }

    public function login(Request $request)
    {
       // Валидация входных данных
    $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
    ]);

    // Пытаемся аутентифицировать пользователя
    if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        $user = Auth::user();

        // Проверка на заблокированного пользователя
        if ($user->banned == 1) {
            // Если пользователь заблокирован, выполняем выход и возвращаем сообщение
            Auth::logout();
            return response()->json(['message' => "You're banned."], 403); // Код 403 Forbidden
        }

        // Если пользователь не заблокирован, создаем токен
        $token = $user->createToken('User Token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Login successful'
        ]);
    } else {
        return response()->json(['message' => 'Login failed or user not found'], 401);
    }
    }

    public function getUsers(Request $request)
    {
        return User::all();
    }

    public function getUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function index()
    {
        return response()->json(User::all());
    }

    public function GetPasteList()
    {
        return response()->json(Paste::all());
    }

    public function GetComplaintList()
    {
        return response()->json(Complaints::all());
    }

    public function GetPaste($short_url)
    {
        $paste = Paste::where('short_url', $short_url)->first();

        if (!$paste) {
            return response()->json(['message' => 'Paste not found'], 404);
        }

        return response()->json($paste);
    }

    public function deletePaste($short_url)
{
    // Получаем текущего аутентифицированного пользователя
    $user = auth()->user();

    // Находим пасту по ссылке
    $paste = Paste::where('short_url', $short_url)->first();

    // Проверяем, существует ли паста
    if (!$paste) {
        return response()->json(['message' => 'Paste not found'], 404);
    }

    // Проверяем, является ли пользователь администратором или владельцем пасты
    if ($user->role === 'admin' || $paste->user_id === $user->id) {
        // Удаляем пасту
        $paste->delete();
        return response()->json(['message' => 'Paste deleted successfully'], 200);
    }

    // Если пользователь не имеет прав на удаление
    return response()->json(['message' => 'Unauthorized'], 403);
}
}
