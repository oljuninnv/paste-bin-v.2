<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paste;
use App\Models\Category;
use App\Models\Syntax;
use App\Models\Rights;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Illuminate\Support\Str;
use App\Models\access_time; 

class ArchivePastesController extends Controller
{

    public function syntax()
    {
        return $this->belongsTo(Syntax::class, 'syntax_id'); // Убедитесь, что здесь указан правильный внешний ключ
    }
    public function index (request $request){

        // Получаем текущего аутентифицированного пользователя
        $user = Auth::user();

        // Получаем последние 10 паст, соответствующих условиям
        $pastesQuery = Paste::where('rights_id', 1) // Пасты с rights_id = 1
            ->where(function($query) {
                $query->where('access_time', '<', now()) // Текущая дата > access_time
                    ->orWhereNull('access_time'); // Или access_time = null
            });

        // Если пользователь аутентифицирован, добавляем условие по user_id
        if ($user) {
            $pastesQuery->where('user_id', '!=', $user->id); // Пасты не созданные пользователем
        }

        $pastes = $pastesQuery->orderBy('created_at', 'desc') // Сортировка по дате создания
            ->take(10) // Ограничение до 10 штук
            ->get();
        
            $syntaxes = Syntax::all();
            return view('pastes', compact('pastes','syntaxes'));
    }

    public function show($short_url)
    {
        // Ищем пасту по short_url
        $paste = Paste::where('short_url', $short_url)->firstOrFail();

        $username = User::find($paste->user_id, 'name');
        $syntax = Syntax::find($paste->syntax_id, 'name');
        // Передаем пасту в представление
        return view('user_paste', compact('paste','username','syntax'));
    }

    public function personal_pastes(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            // Если пользователь не авторизован, можно вернуть пустое представление или редиректить
            return view('mypaste', ['pastes' => [], 'syntaxes' => [], 'categories' => [], 'rights' => []]);
        }
    
        // Получаем последние 10 паст, соответствующих условиям
        $pastesQuery = Paste::where(function($query) {
            $query->where('access_time', '<', now()) // Текущая дата > access_time
                  ->orWhereNull('access_time'); // Или access_time = null
        });
    
        // Добавляем условие по user_id для аутентифицированного пользователя
        $pastesQuery->where('user_id','=',$user->id); // Пасты, созданные пользователем
    
        $pastes = $pastesQuery->orderBy('created_at', 'desc')->get();
        
        $syntaxes = Syntax::all();
        $categories = Category::all(); // Получаем все категории
        $rights = Rights::all(); // Получение всех прав
    
        return view('mypaste', compact('pastes', 'syntaxes', 'categories', 'rights')); // Передаем данные в представление
    }

    public function personal_paste(request $request,$short_url)
    {
        // Ищем пасту по short_url
        $paste = Paste::where('short_url', $short_url)->firstOrFail();

        $username = User::find($paste->user_id, 'name');
        $syntax = Syntax::find($paste->syntax_id, 'name');
        $category = Category::find($paste->category_id_id, 'name');

        // Передаем пасту в представление
        return view('user_paste', compact('paste','username','syntax','category'));
    }
}
