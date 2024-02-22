<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerQueryController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;

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

Route::get('/previous', function () {return view('previous-orders');})->name('previous-orders');
Route::get('/wishlist', function() {return view('wishlist');})->name('wishlist');

Route::get('/books', [BookController::class, 'indexClear'])->name('books.index');
Route::get('/books/sort', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->where('id', '[0-9]+')->name('books.show');
Route::get('/books/category/{category_slug}', [BookController::class, 'indexCategory'])->name('books.category');
Route::get('/books/search/', [BookController::class, 'indexFilter'])->name('books.filter');
Route::get('/books/sort/', [BookController::class, 'setSortType'])->name('books.sort');


Route::post('/basket/{id}', [BasketController::class, 'store'])->name('basket.store');
Route::get('/basket', [BasketController::class, 'index'])->name('basket');
Route::put('/basket/{id}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/{id}', [BasketController::class, 'destroy'])->name('basket.destroy');

Route::post('/wishlist/{id}', [WishlistController::class, 'store'])->name('wishlist.store');
Route::post('/basket/wishlist/{id}', [WishlistController::class, 'basket'])->name('wishlist.basket');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'create'])->name('order.create');
Route::get('/order/previous', [OrderController::class, 'previous'])->name('order.previous');
Route::delete('/order/{id}', [OrderController::class, 'return'])->name('order.return');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contact', [CustomerQueryController::class, 'show'])->name('contact.show');
Route::post('/contact', [CustomerQueryController::class, 'store'])->name('contact.store');

Route::get('/books/create', [BookController::class, 'create'])->middleware('role:admin')->name('books.create');
Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
Route::post('/books/{id}', [BookController::class, 'save'])->middleware('role:admin')->name('books.save');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('role:admin')->name('books.destroy');
Route::post('/books', [BookController::class, 'store'])->middleware('role:admin')->name('books.store');

Route::middleware('role:admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/admin/books', [AdminController::class, 'books'])->name('admin-books');
    Route::get('/admin/queries', [AdminController::class, 'queries'])->name('queries');
    Route::post('/admin/queries/{id}', [AdminController::class, 'queriesStatus'])->name('queries.status');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin-users');
    Route::get('/admin/users/edit/{id}', [AdminController::class, 'edit'])->name('admin-users-edit');
    Route::post('/admin/users/edit/{id}', [AdminController::class, 'save'])->name('admin-users-save');
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin-orders');
    Route::post('/admin/orders/{id}', [AdminController::class, 'process'])->name('admin-process');
});

Route::post('/save-view-choice', [SessionController::class, 'saveViewChoice'])->name('save.view.choice');

require __DIR__.'/auth.php';
