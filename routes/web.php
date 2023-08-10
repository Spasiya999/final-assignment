<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomSearchController;
use App\Http\Controllers\WebbookingController;
use App\Http\Controllers\WebOrderController;
use App\Http\Controllers\payment\PayhereController;
use Illuminate\Support\Facades\Route;

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
    return view('home.index');
})->name('home');

Route::get('/home', function () {
    return view('home.index');
})->name('home');

Route::get('/rooms', function(){
    return view('home.rooms');
})->name('room.list');

Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//dashboard
Route::middleware(['auth', 'permission:rooms'])->group(function () {
    Route::prefix('/admin/dashboard')->group(function () {
    //Rooms CRUD
        Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
        Route::prefix('/room')->group(function(){
            Route::get('/add',[RoomController::class, 'create'])->name('room.create');
            Route::post('/add',[RoomController::class, 'store'])->name('room.store');
            Route::get('/{room}/edit',[RoomController::class, 'edit'])->name('room.edit');
            Route::put('/{room}/edit',[RoomController::class, 'update'])->name('room.update');
            Route::delete('/{room}/delete',[RoomController::class, 'destroy'])->name('room.destroy');
            Route::post('/image-upload', [RoomController::class, 'imageUpload'])->name('room.image.upload');
        });
    });
});

Route::get('/search', [RoomSearchController::class, 'index'])->name('search');
Route::get('room/{room}', [RoomSearchController::class, 'inside'])->name('room.inside');

// bookings
Route::post('booking/create', [WebbookingController::class, 'create'])->name('booking.create');
Route::post('booking/confirm', [WebbookingController::class, 'confirm'])->name('booking.confirm');

//cart
Route::get('cart', [WebOrderController::class, 'cart'])->name('cart');
Route::post('cart/create', [WebOrderController::class, 'create'])->name('order.create');
Route::get('cart/checkout/{id}', [WebOrderController::class, 'checkout'])->name('cart.checkout');
Route::post('cart/confirm/{id}', [WebOrderController::class, 'confirm'])->name('cart.confirm');

//payhere
Route::get('order/pay/{id}', [PayhereController::class, 'pay'])->name('payhere.pay');

require __DIR__.'/auth.php';

Auth::routes();
