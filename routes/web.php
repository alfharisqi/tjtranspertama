<?php

use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route untuk halaman landing, tentang, destinasi, dan kontak
Route::get('/', function () {
    return view('landing');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/destination', function () {
    return view('destination');
});

Route::get('/contact', function () {
    return view('contact');
});

// Route yang memerlukan autentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Order Route
    Route::resource('/orders', OrderController::class);

    // Transaction Route
    Route::resource('/transactions', TransactionController::class);

    // Airline Route
    Route::resource('/airlines', AirlineController::class)->middleware('can:isAdmin');

    // Type Route
    Route::resource('/types', TypeController::class)->middleware('can:isAdmin');

    // Track Route
    Route::resource('/tracks', TrackController::class)->middleware('can:isAdmin');

    // Ticket Route
    Route::resource('/tickets', TicketController::class);

    // Price Route
    Route::resource('/prices', PriceController::class);

    // Method Route
    Route::resource('/methods', MethodController::class)->middleware('can:isAdmin');

    // User Route
    Route::resource('/users', UserController::class);

    Route::get('/checkprice', [OrderController::class, 'checkprice']);
});

