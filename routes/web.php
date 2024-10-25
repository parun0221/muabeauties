<?php

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

Route::get('/register', [\App\Http\Controllers\RegisterController::class,'index']);
Route::post('/register', [\App\Http\Controllers\RegisterController::class,'store']);
Route::get('/login', [\App\Http\Controllers\LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\LoginController::class,'authenticate']);
Route::get('/logout', [\App\Http\Controllers\LoginController::class,'logout']);

Route::resource('/dashboard-muatype', \App\Http\Controllers\MuatypeController::class);

Route::resource('/dashboard-admin', \App\Http\Controllers\AdminController::class);

// Route::resource('/spesialisasi', \App\Http\Controllers\AdminMuaTypeController::class);