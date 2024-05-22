<?php

use App\Http\Controllers\UserController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home', ['title' => 'Beranda']);
});

Route::get("/gallery", function () {
    return view('gallery', ['title' => 'Galeri']);
});

Route::get('/booking', function() {
    
    $result = null;

    if(Auth::check()){
        $result = Booking::where('user_id', auth()->user()->id)->get();
    }
    return view('booking', ['title' => 'Booking', 'books' => $result]);
});

Route::controller(UserController::class)->group(function () {
    // login
    Route::get("/login",'login');
    Route::post("/login",'auth');
    
    // register
    Route::get("/register",'register');
    Route::post('/register', 'store');
    
    // edit
    Route::get('/user/{user}', 'edit');
    Route::post('/personal-data-edit', 'personal_data_edit');
    Route::post('/password-edit', 'password_edit');
    
    // logout
    Route::post('/logout', 'logout');
});


Route::post("/booking", function() {

    request()->validate([
        'date' => ['required'],
        'time' => ['required'],
        'place' => ['required']
        
    ]);

    Booking::create([
        'user_id' => auth()->user()->id,
        'date' => request('date'),
        'time' => request('time'),
        'place' => request('place')
    ]);

    toast("Booking anda telah dikirim <br>Silahkan tunggu konfirmasi dari kami",'success');
    return redirect()->back();
});