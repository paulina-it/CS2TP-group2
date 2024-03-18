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
        $selectedLanguages = $request->input('lang', session()->get('selectedLanguages', []));
        $selectedStock = $request->input('stock', session()->get('selectedStock', 'all-stock'));
        $search = $request->input('search');
        $categorySlug = session()->get('category');

        return redirect()->route('books.index', 
        ['sort' => $sort, 
        'search' => $search, 
        'selectedLanguages' => $selectedLanguages, 
        'selectedStock' => $selectedStock,
        'category' => $categorySlug,]);
    }
}
