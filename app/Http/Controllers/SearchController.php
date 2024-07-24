<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use App\Models\Syntax;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $user = auth()->user(); // Получаем текущего аутентифицированного пользователя

        // Начинаем построение запроса
        $pastesQuery = Paste::query();

        // Проверяем, есть ли текущий пользователь
        if ($user) {
            // Если это паста пользователя, ищем любые пасты с учетом access_time
            $pastesQuery->where(function($q) use ($query) {
            $q->where('title', 'LIKE', '%' . $query . '%')
              ->where(function($q) {
                  $q->whereNull('access_time')
                    ->orWhere('access_time', '>', now());
              });
            });
        } else {
        // Если это не пользователь, ищем только пасты с rights_id = 1
        $pastesQuery->where('rights_id', 1)
                     ->where('title', 'LIKE', '%' . $query . '%');
    }

    // Получаем результаты
    $pastes = $pastesQuery->get();
    $syntaxes = Syntax::all(); // Получаем все синтаксисы

    return view('search', compact('pastes', 'syntaxes'));
    }
}
