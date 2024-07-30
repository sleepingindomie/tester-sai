<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/main', [DashboardController::class, 'main'])->name('main')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard/shipping-info', [DashboardController::class, 'getShippingInfo'])->name('dashboard.shipping_info');

Route::get('/review', [ReviewController::class, 'index'])->name('review')->middleware('auth');
Route::post('/review/confirm-progress', [ReviewController::class, 'confirmProgress'])->name('confirm_progress')->middleware('auth');
Route::post('/review/lock-unlock', [ReviewController::class, 'lockUnlock'])->name('lock_unlock')->middleware('auth');
Route::get('/get_voyages', [ReviewController::class, 'getVoyages'])->name('get_voyages')->middleware('auth');
Route::get('/view_file', [ReviewController::class, 'viewFile'])->name('view_file')->middleware('auth');
Route::get('/view', [ReviewController::class, 'view'])->middleware('auth');

Route::get('/account', [AccountController::class, 'index'])->name('account.index')->middleware('auth');
Route::post('/account/add', [AccountController::class, 'addUser'])->name('account.add')->middleware('auth');
Route::post('/account/delete', [AccountController::class, 'deleteUser'])->name('account.delete')->middleware('auth');

Route::get('/vessel', [VesselController::class, 'index'])->name('vessel.index')->middleware('auth');
Route::post('/vessel/add', [VesselController::class, 'addVessel'])->name('vessel.add')->middleware('auth');
Route::post('/vessel/addBooking', [VesselController::class, 'addBooking'])->name('vessel.addBooking')->middleware('auth');
Route::post('/vessel/deleteBooking', [VesselController::class, 'deleteBooking'])->name('vessel.deleteBooking')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/input', [ShippingController::class, 'inputForm'])->name('input.form');
    Route::post('/input', [ShippingController::class, 'submitInputForm'])->name('input.submit');
    Route::post('/submit-container', [ShippingController::class, 'submitContainer'])->name('container.submit');
    Route::get('/inputpage2', [ShippingController::class, 'inputPage2'])->name('inputpage2');
    Route::post('/inputpage2/submit', [ShippingController::class, 'submitContainer2'])->name('inputpage2.submit'); 
    Route::get('/attachedsheet/{bl}', [ShippingController::class, 'attachedSheet'])->name('attachedsheet');

    Route::get('/notfound', function () {
        return view('notfound');
    })->name('notfound');

    Route::get('/main', [DashboardController::class, 'main'])->name('main');
});
