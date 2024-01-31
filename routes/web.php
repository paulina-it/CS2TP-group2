<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerQueryController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () {return view('about-us');})->name('about-us'); 
// Route::get('/languages', function () {return view('languages');})->name('languages'); //temp?
Route::get('/cart', function () {return view('shopping-cart');})->name('shopping-cart');
Route::get('/checkout', function () {return view('checkout');})->name('checkout');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->where('id', '[0-9]+')->name('books.show');
Route::get('/books/category/{category_slug}', [BookController::class, 'indexCategory'])->name('books.category');


Route::post('/basket/{id}', [BasketController::class, 'store'])->name('basket.store');
Route::get('/basket', [BasketController::class, 'index'])->name('basket');
Route::delete('/basket/{id}', [BasketController::class, 'destroy'])->name('basket.destroy');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'create'])->name('order.create');
Route::get('/order/previous', [OrderController::class, 'previous'])->name('order.previous');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contact', [CustomerQueryController::class, 'show'])->name('contact.show');
Route::post('/contact', [CustomerQueryController::class, 'store'])->name('contact.store');

Route::get('/books/create', [BookController::class, 'create'])->middleware('role:admin')->name('books.create');
Route::get('/books/edit/{id}', [BookController::class, 'edit'])->middleware('role:admin')->name('books.edit');
Route::post('/books/{id}', [BookController::class, 'save'])->middleware('role:admin')->name('books.save');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('role:admin')->name('books.destroy');
Route::post('/books', [BookController::class, 'store'])->middleware('role:admin')->name('books.store');


require __DIR__.'/auth.php';