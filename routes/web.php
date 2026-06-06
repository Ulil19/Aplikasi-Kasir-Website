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
        route::post('/kategori/simpan', [KategoriController::class, 'simpan'])->name('pemilik.kategori.simpan');
        route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('pemilik.kategori.update');
        route::post('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('pemilik.kategori.hapus');

        Route::get('/produk', [ProdukController::class, 'index'])->name('pemilik.produk');
        route::post('/produk/simpan', [ProdukController::class, 'simpan'])->name('pemilik.produk.simpan');
        route::post('/produk/update/{id}', [ProdukController::class, 'update'])->name('pemilik.produk.update');
        route::post('/produk/hapus/{id}', [ProdukController::class, 'hapus'])->name('pemilik.produk.hapus');
        route::post('/produk/restore/{id}', [ProdukController::class, 'restore'])->name('pemilik.produk.restore');
    });

    // kasir
    Route::middleware('role:kasir')->prefix('kasir')->group(function () {
        Route::get('/transaksi', [TransaksiKasirController::class, 'index'])->name('kasir.transaksi');

    });
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
