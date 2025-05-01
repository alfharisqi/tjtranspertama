<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TrainController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\UserController;

require __DIR__ . '/auth.php';

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group 
| which contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/about', function () {
    return view('about');
});

    // Orders route
    Route::resource('/pesantiket', OrderController::class);  // Tetap menggunakan OrderController untuk handle pemesanan tiket

    // Ticket Route (jika masih diperlukan)
    Route::resource('/tickets', TicketController::class);

// Pindahkan rute pesantiket ke halaman utama
Route::get('/pesantiket', [OrderController::class, 'create'])->name('pesantiket');

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

    // Transaction Route
    Route::resource('/transactions', TransactionController::class);

    // Train Route
    Route::resource('/trains', TrainController::class)->middleware('can:isAdmin');

    // Track Route
    Route::resource('/tracks', TrackController::class)->middleware('can:isAdmin');

    // Price Route
    Route::resource('/prices', PriceController::class);

    // Method Route
    Route::resource('/methods', MethodController::class)->middleware('can:isAdmin');

    // User Route
    Route::resource('/users', UserController::class);

    // Profile route for deleting image
    Route::delete('/profile/delete-image', [UserController::class, 'deleteImage'])->name('user.deleteImage');
});

