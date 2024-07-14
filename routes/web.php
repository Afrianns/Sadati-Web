<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\admin;
use App\Http\Middleware\auth;
use App\Http\Middleware\emailVerify;
use App\Http\Middleware\guest;
use App\Http\Middleware\verifiedEmail;
use App\Mail\MailableVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



// Route General
Route::get('/', function () {
    return view('home', ['title' => 'Beranda']);
});

Route::get("/gallery", function () {
    return view('gallery', ['title' => 'Galeri']);
});

Route::view('/about-us','about-us',['title' => 'Tentang Kami']);

// w/ booking user data if user login & exist
Route::get('/booking', [BookingController::class,'booking']);

// w/ booking user ability to create booking and delete booking
Route::post("/booking", [BookingController::class, 'create']);
Route::delete('/booking', [BookingController::class, 'delete_by_user']);


// Route for package & prices bundles
Route::controller(PackageController::class)->group(function () {
    Route::get("/packages", 'index');
    Route::get('/admin/packages','show')->middleware(admin::class);
    Route::post('/admin/packages/edit','edit')->middleware(admin::class);
    Route::get('/admin/packages/create/{category?}','add')->middleware(admin::class);
    Route::post('/admin/packages/create','postAdd')->middleware(admin::class);
    Route::delete('/admin/package/delete','deletePackage')->middleware(admin::class);
});

// Route Users
Route::controller(UserController::class)->group(function () {
    // login
    Route::get("/login",'login')->middleware(auth::class);
    Route::post("/login",'auth')->middleware(auth::class);;
    
    // register
    Route::get("/register",'register')->middleware(auth::class);
    Route::post('/register', 'store')->middleware(auth::class);

    // edit
    Route::get('/user/{user}', 'edit')->middleware([guest::class, verifiedEmail::class]);
    Route::patch('/personal-data-edit', 'personal_data_edit')->middleware([guest::class, verifiedEmail::class]);
    Route::patch('/password-edit', 'password_edit')->middleware([guest::class, verifiedEmail::class]);
    
    // logout
    Route::post('/logout', 'logout');

    // Payment
    
    Route::post('/payment', 'payment');
});

// Admin Routes
Route::prefix('admin')->controller(BookingController::class)->group(function() {
    Route::get('/confirm/{sort?}', 'confirm');
    Route::get('/confirmed/{sort?}/{Ptype?}', 'confirmed');

    Route::patch('/history', 'addHistoryPost');
    Route::get('/history', 'history');
    Route::patch('/booking', 'Confirmation');
    Route::get('/', 'index');
})->middleware(admin::class);


// default route to unconfirm booking if login user is admin 
// Route::get('/admin', [BookingController::class,'index'])->middleware(admin::class);


// Send Invoice to user after finished pay
// Route::get('sendingpay', function() {
//     Mail::to('hanifnandaafrian9@gmail.com')->send(new MailableVerification("Alex"));
// });

// Route::get('/email/verify', function () {
//     return view('Auth.verify-email');
// })->middleware('guest')->name('verification.notice');


// Email Activation Routes
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['email-verify', 'signed'])->name('verification.verify');
 

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    toast('Link verifikasi berhasil dikirim','success');
    return redirect('/');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// After Payment Route

Route::controller(PaymentController::class)->group(function () {
    Route::get('payment/success/{id}/{data}', 'successPay')->name("payment-success");
    // Route::post('payment/success', 'successPay')->name("payment-success");
    Route::get('payment/failed/{data}', 'failedPay')->name("payment-failed");

    // Payment Invoice
    
    // Route::get('/payment/invoice/{id}', 'invoice');
});