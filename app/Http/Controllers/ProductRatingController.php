<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    public function create($id) {
        if (Auth::check()) {
            $rating = new ProductRating;
            $rating->score = request('score');
            $rating->review = request('review');
            $rating->user_id = Auth::id();
            $rating->book_id = $id;
            $rating->save();
            return back();
        } else {
            return back()->withErrors(['msg' => 'Please log in to leave a review']);
        }
    }
}
