@extends('layouts.app')

@section('title', 'Dashboard Pemilik')
@section('header', 'Dashboard Pemilik')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Selamat datang di Dashboard {{ Auth::user()->nama }}!</h3>
        <p class="text-gray-600">Di sini Anda dapat melihat ringkasan penjualan, mengelola produk, dan memantau kinerja toko
            Anda.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <div class="bg-blue-100 p-4 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-blue-600">Total Penjualan Hari Ini</h4>
                <p class="text-2xl font-bold text-blue-800">Rp {{ number_format($transaksiCount, 0, ',', '.') }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-green-600">Produk Terlaris</h4>
                <p class="text-2xl font-bold text-green-800">{{ $produkterlaris->nama ?? 'Tidak ada data' }} -
                    {{ $produkterlaris->total_terjual ?? 0 }} terjual</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-yellow-600">Jumlah Transaksi Hari Ini</h4>
                <p class="text-2xl font-bold text-yellow-800">{{ $transaksiDetailCount }} Transaksi</p>
            </div>
        </div>
    </div>
@endsection
