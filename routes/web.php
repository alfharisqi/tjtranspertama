<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TrainController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\UserController;

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

// Route group for authenticated and verified users
Route::middleware(['auth', 'verified'])->group(function () {
    // Print Testing Route
    Route::get('/print', [PrintController::class, 'index']);
    Route::get('/printpdf', [PrintController::class, 'print']);

    // Complaint Route
    Route::resource('/complaints', ComplaintController::class);

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Order Route
    Route::resource('/orders', OrderController::class);


    // Transaction Route
    Route::resource('/transactions', TransactionController::class);

    // Train Route
    Route::resource('/trains', TrainController::class)->middleware('can:isAdmin');

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

    // routes/web.php
    Route::delete('/profile/delete-image', [UserController::class, 'deleteImage'])->name('user.deleteImage');

    // Check Price Route
    Route::get('/checkprice', [OrderController::class, 'checkprice']);
});
