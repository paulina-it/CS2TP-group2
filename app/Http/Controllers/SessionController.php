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

        $sort = session()->get('sort', 'price-asc');
        $selectedLanguages = request('lang') ?? [];
        $selectedStock = request('stock') ?? 'all-stock';
        $search = request('search');

        return redirect()->route('books.index', ['sort' => $sort, 'search' => $search, 'selectedLanguages' => $selectedLanguages, 'selectedStock' => $selectedStock]);
    }
}
