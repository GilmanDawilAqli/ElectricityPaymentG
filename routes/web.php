<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemakaianController;
use App\Http\Controllers\PembayaranController;
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

// Route::middleware('auth')->group(function () {
//     Route::get('/history', function () {
//         return view('history', ['title' => 'History']);
//     });
// });

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
Route::resource('pelanggan', PelangganController::class);
// CRUD TARIF
Route::resource('tarif', TarifController::class);
// CRUD Pemakaian
Route::resource('pemakaian', PemakaianController::class);
Route::get('/search-nokontrol', [PemakaianController::class, 'searchNoKontrol'])->name('search.nokontrol');
Route::get('/get-pelanggan-info/{NoKontrol}', [PemakaianController::class, 'getPelangganInfo']);


// Petugas
Route::resource('petugas', UserController::class);

// Pembayaran
Route::resource('pembayaran', PembayaranController::class);
Route::get('/pembayaran/bayar/{id}', [PembayaranController::class, 'showFormBayar'])->name('pembayaran.form_bayar');
Route::post('/pembayaran/proses/{id}', [PembayaranController::class, 'processBayar'])->name('pembayaran.proses_bayar');