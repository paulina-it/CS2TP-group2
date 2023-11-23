<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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


Route::get('/', function () {return view('home');})->name('home');
Route::get('/book', function () {return view('book');})->name('book');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->where('id', '[0-9]+')->name('books.show');

Route::post('/basket/{id}', [BasketController::class, 'store'])->middleware('auth')->name('basket.store');
Route::get('/basket', [BasketController::class, 'index'])->middleware('auth')->name('basket');
Route::delete('/basket/{id}', [BasketController::class, 'destroy'])->middleware('auth')->name('basket.destroy');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/books/create', [BookController::class, 'create'])->middleware('role:admin')->name('books.create');
Route::get('/books/edit/{id}', [BookController::class, 'edit'])->middleware('role:admin')->name('books.edit');
Route::post('/books/{id}', [BookController::class, 'save'])->middleware('role:admin')->name('books.save');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('role:admin')->name('books.destroy');
Route::post('/books', [BookController::class, 'store'])->middleware('role:admin')->name('books.store');


require __DIR__.'/auth.php';
