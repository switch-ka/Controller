<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Make the login page the landing page
Route::get('/', function () {
    return redirect()->route('login');
});

// Route to show the create ticket form, middleware added
Route::get('/create-ticket', [TicketController::class, 'create'])
    ->middleware('auth')  // Apply auth middleware
    ->name('create-ticket');

// Route to handle form submission (store the ticket)
Route::post('/store-ticket', [TicketController::class, 'store'])
    ->middleware('auth')  // Apply auth middleware
    ->name('store-ticket');

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Separate POST routes for user and admin logins
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.submit');
Route::post('/admin-login', [AuthController::class, 'loginAdmin'])->name('admin.login');

// **Logout route updated to POST**
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User and Admin-specific routes with middleware for user type
Route::get('/create-ticket', function () {
    if (session('user_type') === 'user') {
        return view('create-ticket');
    }
    return redirect()->route('login');
})->middleware('auth')->name('create-ticket');  // Apply auth middleware here

Route::get('/view-ticket', function () {
    if (session('user_type') === 'admin') {
        return view('view-ticket');
    }
    return redirect()->route('login');
})->middleware('auth')->name('view-ticket');  // Apply auth middleware here
