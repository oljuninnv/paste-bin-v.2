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
        $user = auth()->user(); 

        $pastesQuery = Paste::query();

        if ($user) {
            $pastesQuery->where(function($q) use ($query) {
            $q->where('title', 'LIKE', '%' . $query . '%')
              ->where(function($q) {
                  $q->whereNull('access_time')
                    ->orWhere('access_time', '>', now());
              });
            });
        } else {
        $pastesQuery->where('rights_id', 1)
                     ->where('title', 'LIKE', '%' . $query . '%');
        }


    $pastes = $pastesQuery->get();
    $syntaxes = Syntax::all();

    return view('search', compact('pastes', 'syntaxes'));
    }
}
