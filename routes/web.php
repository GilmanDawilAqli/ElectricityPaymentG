<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['title' => 'Welcome']);
});

Route::get('/home', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/pembayaran', function () {
    return view('pembayaran', ['title' => 'Pembayaran']);
});

Route::get('/pelanggan', function () {
    return view('pelanggan', ['title' => 'Pelanggan']);
});

Route::get('/petugas', function () {
    return view('petugas', ['title' => 'Petugas']);
});

Route::get('/history', function () {
    return view('history', ['title' => 'History']);
});