<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paste;
use App\Models\Complaints;

class ReportController extends Controller
{
    public function index(request $request, $short_url)
    {
        $paste = Paste::where('short_url', $short_url)->firstOrFail();
        return view('report', compact('paste'));
    }

    public function send_report(Request $request,$short_url){
        // Валидация входящих данных
        $request->validate([
            'text' => 'required|string|max:255',
            'name' => 'required|string|max:100',
        ]);

        // Получаем запись Paste по short_url
        $paste = Paste::where('short_url', $short_url)->firstOrFail();

        // Создаем новую жалобу
        Complaints::create([
            'paste_id' => $paste->id,
            'username' => $request->name,
            'reason' => $request->text,
        ]);

        // Увеличиваем количество жалоб в Paste
        $paste->increment('complaints');

        // Перенаправляем пользователя с сообщением об успехе
        return redirect()->route('report', ['short_url' => $short_url])->with('success', 'Жалоба успешно отправлена.');
    
    }
}
