<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//dashboard
Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
    //Rooms CRUD
        Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
        Route::prefix('/room')->group(function(){
            Route::get('/add',[RoomController::class, 'create'])->name('room.create');
            Route::post('/add',[RoomController::class, 'store'])->name('room.store');
            Route::get('/{room}/edit',[RoomController::class, 'edit'])->name('room.edit');
            Route::put('/{room}/edit',[RoomController::class, 'update'])->name('room.update');
            Route::delete('/{room}/delete',[RoomController::class, 'destroy'])->name('room.destroy');
        });
    });
});

require __DIR__.'/auth.php';

Auth::routes();
