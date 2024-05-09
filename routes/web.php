<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


require __DIR__.'/auth.php';

Route::get('/print', [PrintController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/printpdf', [PrintController::class, 'print'])->middleware(['auth', 'verified']);

// Complaint Route
Route::resource('/complaints', ComplaintController::class)->middleware(['auth', 'verified']);

//  Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);

//  Order Route
Route::resource('/orders', OrderController::class)->middleware(['auth', 'verified']);

//  Transaction Route
Route::resource('/transactions', TransactionController::class)->middleware(['auth', 'verified']);

//  Airline Route
Route::resource('/airlines', AirlineController::class)->middleware(['auth', 'verified', 'can:isAdmin']);

//  Type Route
Route::resource('/types', TypeController::class)->middleware(['auth', 'verified', 'can:isAdmin']);

//  Track Route
Route::resource('/tracks', TrackController::class)->middleware(['auth', 'verified', 'can:isAdmin']);

//  Ticket Route
Route::resource('/tickets', TicketController::class)->middleware(['auth', 'verified']);

//  Price Route
Route::resource('/prices', PriceController::class)->middleware(['auth', 'verified']);

//  Method Route
Route::resource('/methods', MethodController::class)->middleware(['auth', 'verified', 'can:isAdmin']);

//  User Route
Route::resource('/users', UserController::class)->middleware(['auth', 'verified']);

// Check Price Route
Route::get('/checkprice', [OrderController::class, 'checkprice', 'verified']);