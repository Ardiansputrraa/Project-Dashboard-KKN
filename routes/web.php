<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DplController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;


Route::controller(AuthController::class)->group(function (){
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('/', 'login')->name('login');
    Route::post('login', 'loginCheck')->name('login.check');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'updateProfile')->name('profile.update');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(DplController::class)->group(function () {
        Route::get('dpl', 'dpl')->name('dpl');
        Route::get('getDataDpl', 'getData')->name('get.data.dpl');
    });
});

Route::get('/belum-daftar-kkn', function () {
    return view('404/mahasiswa');
})->middleware('auth');

Route::get('/daftar-kelompok-kkn', function () {
    return view('404/dpl');
})->middleware('auth');


Route::get('/home', function () {
    return view('dashboard/index');
})->middleware('auth');

Route::get('/dokumen', function () {
    return view('dashboard/dokumen');
});

Route::get('/logbook', function () {
    return view('dashboard/logbook');
});


Route::get('/kalender-kegiatan', function () {
    return view('dashboard/kalender');
});


Route::get('/sumber-daya', function () {
    return view('dashboard/sumber');
});