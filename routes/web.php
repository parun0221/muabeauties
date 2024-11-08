<?php

use App\Http\Controllers\AdminController;
use App\Models\AdminMuaType;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});

Route::middleware(['web'])->group(function () {
    Route::resource('/spesialisasi', \App\Http\Controllers\AdminMuaTypeController::class);
});
Route::post('/user/newpassword', [\App\Http\Controllers\UserController::class, 'newpassword'])->name('user.newpassword');

Route::get('/register', [\App\Http\Controllers\RegisterController::class,'index']);
Route::post('/register', [\App\Http\Controllers\RegisterController::class,'store']);
Route::get('/login', [\App\Http\Controllers\LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\LoginController::class,'authenticate']);
Route::get('/logout', [\App\Http\Controllers\LoginController::class,'logout']);

Route::resource('/dashboard-muatype', \App\Http\Controllers\MuatypeController::class);

Route::resource('/message', \App\Http\Controllers\MessageController::class);

Route::resource('/dashboard-admin', \App\Http\Controllers\AdminController::class);

Route::resource('/profile', \App\Http\Controllers\UserController::class);

Route::resource('/galery', \App\Http\Controllers\GaleryMuaController::class);

Route::resource('/order', \App\Http\Controllers\OrderController::class);

// Route::resource('/spesialisasi', \App\Http\Controllers\AdminMuaTypeController::class);

Route::get('/contacts', [\App\Http\Controllers\MessageController::class, 'getContacts']);
Route::get('/get-muatypes/{adminbookingId}', [AdminController::class, 'getMuatypesByAdmin']);


Route::delete('/dashboard-muatype/{muatype}', [\App\Http\Controllers\MuatypeController::class, 'destroy'])->name('muatype.destroy');
