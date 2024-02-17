<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function saveViewChoice(Request $request)
    {
        $viewChoice = $request->input('view_choice') ?? 'rows';
        Session::put('view_choice', $viewChoice);
        // return response()->json(['success' => true]);
        return redirect()->route('books.index');
    }
}
