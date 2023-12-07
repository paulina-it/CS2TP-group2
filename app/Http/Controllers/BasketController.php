<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\cart;
use App\Models\Book;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index() {
        $user_id = Auth::id();
        $basket = cart::where('user_id', $user_id)->get();
        $books = collect();
        //$amounts = array();
        foreach ($basket as $elem) {
            $books->push(Book::where('id', $elem['book_id'])->get());
            //array_push($amounts, $elem['Amount']);     
        }
        return view('/basket', [
            'books' => $books,
            //'amounts' => $amounts,
        ]);
    }

    public function store($book_id) {
        $user_id = Auth::id();

        /*$Amount = cart::where('book_id', $book_id)->where('user_id', $user_id)->get('Amount');
        if ($Amount != "[]") {
            $basket = cart::where('book_id', $book_id)->where('user_id', $user_id)->get();
            $basket[0]->Amount = $Amount[0]->Amount + 1;
            $basket[0]->update();
        } else {*/
            $basket = new cart;
            $basket->user_id = $user_id;
            $basket->book_id = $book_id;
            //$basket->Amount = 1;
            $basket->save();
        //}

        return redirect('basket');
    }
    public function destroy($book_id) {
        $user_id = Auth::id();
        $item = cart::where('book_id', $book_id)->where('user_id', $user_id)->delete();;
        return redirect('basket');
    }
}
