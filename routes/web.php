<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\admin;
use App\Http\Middleware\auth;
use App\Http\Middleware\guest;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;

// Route General
Route::get('/', function () {
    return view('home', ['title' => 'Beranda']);
});

Route::get("/gallery", function () {
    return view('gallery', ['title' => 'Galeri']);
});

Route::get('/booking', function() {
    
    $result = null;

    if(auth()->check()){
        $result = Booking::where('user_id', auth()->user()->id)->get();
    }
    return view('booking', ['title' => 'Booking', 'books' => $result]);
});


// Route Users
Route::controller(UserController::class)->group(function () {
    // login
    Route::get("/login",'login')->middleware(auth::class);
    Route::post("/login",'auth')->middleware(auth::class);;
    
    // register
    Route::get("/register",'register')->middleware(auth::class);
    Route::post('/register', 'store')->middleware(auth::class);;
    
    // edit
    Route::get('/user/{user}', 'edit')->middleware(guest::class);
    Route::patch('/personal-data-edit', 'personal_data_edit')->middleware(guest::class);
    Route::patch('/password-edit', 'password_edit')->middleware(guest::class);
    
    // logout
    Route::post('/logout', 'logout');
});

// Booking routes
Route::post("/booking", [BookingController::class, 'create']);

Route::delete('/booking', [BookingController::class, 'delete_by_user']);

// Admin Routes
Route::prefix('admin')->controller(BookingController::class)->group(function() {
    Route::get('/confirm', 'confirm');
    Route::get('/confirmed', 'confirmed');
    Route::patch('/booking', 'Confirmation');
})->middleware(admin::class);

Route::get('/admin', [BookingController::class,'index'])->middleware(admin::class);
