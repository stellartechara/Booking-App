<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hotels\HotelsController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admins\AdminsController;


//Route::get('/', function () {
 //   return view('welcome');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'hotels'], function() {

    //hotels
    Route::get('/rooms/{id}', [HotelsController::class, 'rooms'])->name('hotel.rooms');   
    Route::get('/rooms-details/{id}', [HotelsController::class, 'roomsDetails'])->name('hotel.rooms.details');
    Route::post('/rooms-booking/{id}', [HotelsController::class, 'roomBooking'])->name('hotel.rooms.booking');
    
   // MIDTRANS PAYMENT
    Route::get('/pay', [HotelsController::class, 'payWithMidtrans'])
        ->name('hotel.pay')
        ->middleware('check.for.price');

// USER ENDED ON SUCCESS PAGE
    Route::get('/success', [HotelsController::class, 'success'])
        ->name('hotel.success');

// CALLBACK DARI MIDTRANS (HARUS POST)
    Route::post('/midtrans/callback', [HotelsController::class, 'midtransCallback'])
        ->name('midtrans.callback');

});

//users
Route::get('users/my-bookings', [UsersController::class, 'myBookings'])->name('users.bookings')->middleware('auth:web');

//admin

Route::get('admin/login', [AdminsController::class, 'viewLogin'])->name('view.login')->middleware('check.for.login');
Route::post('admin/login', [AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {

    //admins
    Route::get('/index', [AdminsController::class, 'index'])->name('admins.dashboard');
    Route::get('/all-admins', [AdminsController::class, 'allAdmins'])->name('admins.all');
    Route::get('/create-admins', [AdminsController::class, 'createAdmins'])->name('admins.create');
    Route::post('/create-admins', [AdminsController::class, 'storeAdmins'])->name('admins.store');

    //hotels
    Route::get('/all-hotels', [AdminsController::class, 'allHotels'])->name('hotels.all');
    Route::get('/create-hotels', [AdminsController::class, 'createHotels'])->name('hotels.create');
    Route::post('/create-hotels', [AdminsController::class, 'storeHotels'])->name('hotels.store');
    Route::get('/edit-hotels/{id}', [AdminsController::class, 'editHotels'])->name('hotels.edit');
    Route::put('/update-hotels/{id}', [AdminsController::class, 'updateHotels'])->name('hotels.update');
    Route::get('/delete-hotels/{id}', [AdminsController::class, 'deleteHotels'])->name('hotels.delete');


    //rooms
    Route::get('/all-rooms', [AdminsController::class, 'allRooms'])->name('rooms.all');
    Route::get('/create-rooms', [AdminsController::class, 'createRooms'])->name('rooms.create');
    Route::post('/create-rooms', [AdminsController::class, 'storeRooms'])->name('rooms.store');
    Route::get('/delete-rooms/{id}', [AdminsController::class, 'deleteRooms'])->name('rooms.delete');

    //bookings
    Route::get('/all-bookings', [AdminsController::class, 'allBookings'])->name('bookings.all');
    Route::get('/edit-status/{id}', [AdminsController::class, 'editStatus'])->name('bookings.edit.status');
    Route::post('/update-status/{id}', [AdminsController::class, 'updateStatus'])->name('bookings.update.status');
    Route::get('/delete-bookings/{id}', [AdminsController::class, 'deleteBookings'])->name('bookings.delete');
});

Route::post('admin/logout', function() {
    auth()->guard('admin')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); 
})->name('admin.logout');
