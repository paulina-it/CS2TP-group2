<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    public function create($id) {
        $rating = new ProductRating;
        $rating->score = request('score');
        $rating->review = request('review');
        $rating->user_id = Auth::id();
        $rating->book_id = $id;
        $rating->save();
        return back();
    }
}
