<?php

use App\Http\Controllers\AdminController;
use App\Models\AdminMuaType;
use Illuminate\Support\Facades\Route;
use App\Exports\SalaryReportExport;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('landing');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;



Route::get('/export/pdf/{adminId}', [ReportController::class, 'exportPdf'])->name('export.pdf');
Route::get('/export/excel/{adminId}', [ReportController::class, 'exportExcel'])->name('export.excel');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');



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

Route::resource('/dashboard-customer', \App\Http\Controllers\CustomerController::class);

Route::resource('/profile', \App\Http\Controllers\UserController::class);

Route::resource('/galery', \App\Http\Controllers\GaleryMuaController::class);

Route::resource('/order', \App\Http\Controllers\OrderController::class);
Route::put('/order/cancel/{id}', [\App\Http\Controllers\OrderController::class, 'cancelOrder'])->name('order.cancel');
Route::put('/order/finish/{id}', [\App\Http\Controllers\OrderController::class, 'finishOrder'])->name('order.finish');


Route::resource('/rating', \App\Http\Controllers\RatingController::class);

Route::resource('/ratings', \App\Http\Controllers\SuperRatingController::class);

Route::resource('/payment', \App\Http\Controllers\PaymentController::class);

Route::resource('/reports', \App\Http\Controllers\ReportController::class);

// Route::resource('/spesialisasi', \App\Http\Controllers\AdminMuaTypeController::class);

Route::get('/contacts', [\App\Http\Controllers\MessageController::class, 'getContacts']);
Route::get('/get-muatypes/{adminbookingId}', [AdminController::class, 'getMuatypesByAdmin']);

Route::get('/schedule', [\App\Http\Controllers\OrderController::class, 'getSchedule'])->name('schedule');

Route::get('/schedule-by-date', [\App\Http\Controllers\OrderController::class, 'getOrdersByDate'])->name('schedule-by-date');

Route::get('/admin-reviews/{adminId}', [\App\Http\Controllers\AdminController::class, 'getReviews']);

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/{$id}', [ReportController::class, 'index'])->name('reports.show');





Route::delete('/dashboard-muatype/{muatype}', [\App\Http\Controllers\MuatypeController::class, 'destroy'])->name('muatype.destroy');
