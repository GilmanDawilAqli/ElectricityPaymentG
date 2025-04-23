<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemakaianController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\DB;
//----------------------------------------------------------------- Halaman Tamu/Pelanggan ---------------------------------------------------

// Halaman Welcome/untuk tamu/pelanggan
Route::get('/', function () {
    return view('welcome', ['title' => 'Welcome']);
});

// search pemakaian pelanggan
Route::get('/search-pemakaian', [FrontendController::class, 'search'])->name('search.pemakaian');
Route::get('/search-nokontrol-pemakaian', function (Request $request) {
    $q = $request->q;
    $results = DB::table('pemakaian')
        ->select('NoKontrol')
        ->where('NoKontrol', 'like', "%$q%")
        ->groupBy('NoKontrol')
        ->pluck('NoKontrol');

    return response()->json($results);
});

// Login & Logout
Route::get('/login', function () {
    return view('login', ['title' => 'Login']);
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']); // 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//------------------------------------------------------------------ Halaman User/Petugas ----------------------------------------------------
// Khusus Petugas

// Halaman Home
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home', ['title' => 'Home']);
    });
});

// Halaman Pelanggan
Route::middleware('auth')->group(function () {
    Route::get('/pelanggan', function () {
        return view('pelanggan', ['title' => 'Pelanggan']);
    });
});

// Halaman Pembayaran
Route::middleware('auth')->group(function () {
    Route::get('/pembayaran', function () {
        return view('pembayaran', ['title' => 'Pembayaran']);
    });
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('/pembayaran/{id}/bayar', [PembayaranController::class, 'showFormBayar'])->name('pembayaran.showFormBayar');
    Route::post('/pembayaran/{id}/bayar', [PembayaranController::class, 'processBayar'])->name('pembayaran.processBayar');
});

// CRUD Pemakaian
Route::middleware('auth')->group(function () {
    Route::resource('pemakaian', PemakaianController::class);
    Route::get('/search-nokontrol', [PemakaianController::class, 'searchNoKontrol'])->name('search.nokontrol');
    Route::get('/get-pelanggan-info/{NoKontrol}', [PemakaianController::class, 'getPelangganInfo']);
    Route::get('/pemakaian', function () {
        return view('pemakaian', ['title' => 'Pemakaian']);
    });
    Route::get('/pemakaian', [PemakaianController::class, 'index'])->name('pemakaian.index');
});

// CRUD Pelanggan
Route::middleware('auth')->group(function () {
    Route::resource('pelanggan', PelangganController::class);    
});

//------------------------------------------------------------------- Halaman Atmin -------------------------------------------
// Halaman Khusus Admin

// Halaman CRUD Petugas
Route::middleware('admin')->group(function () {
    Route::get('/petugas', function () {
        return view('petugas', ['title' => 'Petugas']);
    });
    Route::resource('petugas', UserController::class); 
});

// Halaman CRUD Tarif
Route::middleware('admin')->group(function () {
    Route::get('/tarif', function () {
        return view('tarif', ['title' => 'Tarif']);
    });
    Route::resource('tarif', TarifController::class);
});

// Halaman Laporan
Route::middleware('admin')->group(function () {
    Route::get('/laporan', function () {
        return view('laporan', ['title' => 'laporan']);
    });
    Route::middleware('admin')->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/lunas/{id}', [LaporanController::class, 'generateLunasSingle'])->name('laporan.generateLunas');
        Route::get('/laporan/belum-lunas/{id}', [LaporanController::class, 'generateBelumLunasSingle'])->name('laporan.generateBelumLunas');
        Route::get('/laporan/generate-all', [LaporanController::class, 'generateAll'])->name('laporan.generateAll'); 
    });
});
