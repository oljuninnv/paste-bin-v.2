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

class PasteController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $pastesQuery = Paste::where('rights_id', 1)
            ->where(function($query) {
                $query->where('access_time', '<', now()) 
                    ->orWhereNull('access_time');
            });

        if ($user) {
            $pastesQuery->where('user_id', '!=', $user->id); 
        }

        $pastes = $pastesQuery->orderBy('created_at', 'desc') 
            ->take(10) 
            ->get();

        $user_pastes = [];
        if ($user) {
            $user_pastes = Paste::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        }

        $categories = Category::all();
        $syntaxes = Syntax::all();
        $rights = Rights::all();
        $access_times = access_time::all();
        
        return view('paste', compact('categories', 'syntaxes', 'rights', 'access_times', 'user_pastes', 'pastes'));
    }

    public function store(Request $request)
    {
        // Валидация входящих данных
        $request->validate([
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'access_time' => 'nullable|string',
            'tags' => 'nullable|string',
            'syntax_id' => 'required|exists:syntaxes,id',
            'rights_id' => 'required|exists:rights,id',
            'title' => 'required|string|max:255',
            'guest' => 'nullable|boolean',
        ]);

        // Создаем новую пасту
        $paste = new Paste();
        $paste->content = $request->input('content');
        $paste->category_id = $request->input('category_id');

        // Обработка access_time
        $accessTime = $request->input('access_time');    
        $duration = access_time::where('id', $accessTime)->value('time_duration'); // the_duration хранится в минутах
        if ($duration > 0) {
            $paste->access_time = now()->addMinutes($duration); // Добавляем минуты к текущему времени
        } else {
            $paste->access_time = null; // Если не нашли duration, оставляем пустым
         }
        

        $paste->tags = $request->input('tags');
        $paste->syntax_id = $request->input('syntax_id');
        $paste->rights_id = $request->input('rights_id');
        $paste->title = $request->input('title');

        // Проверка авторизации и значения чекбокса "guest"
        if (!Auth::check() || $request->has('guest')) {
            $paste->user_id = null; // Оставить поле пустым
        } else {
            $paste->user_id = Auth::id(); // Добавить ID авторизованного пользователя
        }

        do {
            $shortUrl = Str::random(15);
        } while (Paste::where('short_url', $shortUrl)->exists());
        
        // Присвоение уникального short_url
        $paste->short_url = $shortUrl;

        // Сохранение пасты
        $paste->save();

        // Перенаправление после успешного сохранения
        return redirect()->route('home')->with('success', 'Паста успешно создана!');
    }
}
