<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paste;
use Illuminate\Support\Facades\Auth;

class EditPaste extends Controller
{
    public function edit($id)
    {
        $paste = Paste::findOrFail($id);
        
        // Проверяем, что текущий пользователь является владельцем пасты
        if (Auth::id() !== $paste->user_id) {
            return redirect()->route('pastes.index')->with('error', 'У вас нет прав для редактирования этой пасты.');
        }

        return view('edit', compact('paste'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $paste = Paste::findOrFail($id);

        // Проверяем, что текущий пользователь является владельцем пасты
        if (Auth::id() !== $paste->user_id) {
            return redirect()->route('archive')->with('error', 'У вас нет прав для редактирования этой пасты.');
        }

        $paste->update($request->only(['title', 'content']));

        return redirect()->route('home')->with('success', 'Паста успешно обновлена.');
    }
}
