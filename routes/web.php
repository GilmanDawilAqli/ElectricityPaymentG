<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemakaianController;

//----------------------------------------------------------------- Guest Site

Route::get('/login', function () {
    return view('login', ['title' => 'Login']);
});

Route::get('/', function () {
    return view('welcome', ['title' => 'Welcome']);
});

//------------------------------------------------------------------ User site

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home', ['title' => 'Home']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/history', function () {
        return view('history', ['title' => 'History']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/pelanggan', function () {
        return view('pelanggan', ['title' => 'Pelanggan']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/pembayaran', function () {
        return view('pembayaran', ['title' => 'Pembayaran']);
    });
});



//------------------------------------------------------------------- Atmin Site
Route::middleware('admin')->group(function () {
    Route::get('/petugas', function () {
        return view('petugas', ['title' => 'Petugas']);
    });
});

Route::middleware('admin')->group(function () {
        Route::get('/pemakaian', function () {
        return view('pemakaian', ['title' => 'Pemakaian']);
    });
});


Route::middleware('admin')->group(function () {
    Route::get('/tarif', function () {
        return view('tarif', ['title' => 'Tarif']);
    });
});


// Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']); // 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// CRUD Pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.pelanggan');
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.pelanggan');
Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.pelanggan');
Route::get('/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('pelanggan.pelanggan');
Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.pelanggan');
Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.pelanggan');
Route::get('/pelanggan/{pelanggan}', [PelangganController::class, 'show'])->name('pelanggan.pelanggan');

// CRUD TARIF
Route::resource('tarif', TarifController::class);

Route::resource('pemakaian', PemakaianController::class);