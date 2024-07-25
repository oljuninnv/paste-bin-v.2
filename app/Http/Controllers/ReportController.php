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

        $request->validate([
            'text' => 'required|string|max:255',
            'name' => 'required|string|max:100',
        ]);

        $paste = Paste::where('short_url', $short_url)->firstOrFail();

        Complaints::create([
            'paste_id' => $paste->id,
            'username' => $request->name,
            'reason' => $request->text,
        ]);

        $paste->increment('complaints');

        return redirect()->route('report', ['short_url' => $short_url])->with('success', 'Жалоба успешно отправлена.');
    
    }
}
