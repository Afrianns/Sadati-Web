<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\admin;
use App\Http\Middleware\auth;
use App\Http\Middleware\guest;
use Illuminate\Support\Facades\Route;

// Route General
Route::get('/', function () {
    return view('home', ['title' => 'Beranda']);
});

Route::get("/gallery", function () {
    return view('gallery', ['title' => 'Galeri']);
});

// w/ booking user data if user login & exist
Route::get('/booking', [BookingController::class,'booking']);

// w/ booking user ability to create booking and delete booking
Route::post("/booking", [BookingController::class, 'create']);
Route::delete('/booking', [BookingController::class, 'delete_by_user']);


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

// Admin Routes
Route::prefix('admin')->controller(BookingController::class)->group(function() {
    Route::get('/confirm/{sort?}', 'confirm');
    Route::get('/confirmed', 'confirmed');
    Route::patch('/booking', 'Confirmation');
})->middleware(admin::class);

// default route to unconfirm booking if login user is admin 
Route::get('/admin', [BookingController::class,'index'])->middleware(admin::class);
