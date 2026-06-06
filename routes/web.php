<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Pemilik\DashboardController;
use App\Http\Controllers\Pemilik\KategoriController;
use App\Http\Controllers\Pemilik\ProdukController;
use App\Http\Controllers\Kasir\TransaksiKasirController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'loginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {

    // Pemilik 
    Route::middleware('role:pemilik')->prefix('pemilik')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('pemilik.dashboard');
        Route::get('/kategori', [KategoriController::class, 'index'])->name('pemilik.kategori');
        Route::get('/produk', [ProdukController::class, 'index'])->name('pemilik.produk');
    });

    // kasir
    Route::middleware('role:kasir')->prefix('kasir')->group(function () {
        Route::get('/transaksi', [TransaksiKasirController::class, 'index'])->name('kasir.transaksi');

    });
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
