@extends('layouts.app')

@section('title', 'Dashboard Pemilik')
@section('header', 'Dashboard Pemilik')

@section('content')
    <div class="space-y-6">
        {{-- Banner Selamat Datang --}}
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="text-xl font-bold text-gray-900">Selamat datang kembali, {{ Auth::user()->nama }}!</h3>
            <p class="text-gray-500 text-sm mt-1">Berikut adalah ringkasan performa toko Anda khusus untuk hari ini.</p>
        </div>

        {{-- Grid Kartu Ringkasan Hari Ini --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Kartu 1: Omzet Hari Ini --}}
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center space-x-4">
                <div class="p-3 bg-sky-100 text-sky-600 rounded-lg">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Omzet Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-900">Rp {{ number_format($omzetHariIni, 0, ',', '.') }}</h3>
                </div>
            </div>

            {{-- Kartu 2: Jumlah Transaksi --}}
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center space-x-4">
                <div class="p-3 bg-emerald-100 text-emerald-600 rounded-lg">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Transaksi Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $transaksiCount }} Nota</h3>
                </div>
            </div>

            {{-- Kartu 3: Produk Terlaris --}}
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center space-x-4">
                <div class="p-3 bg-amber-100 text-amber-600 rounded-lg">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                        </path>
                    </svg>
                </div>
                <div class="truncate flex-1">
                    <p class="text-sm text-gray-500 font-medium">Terlaris Hari Ini</p>
                    <h3 class="text-base font-bold text-gray-900 truncate"
                        title="{{ $produkterlaris->nama_produk ?? 'Belum ada data' }}">
                        {{ $produkterlaris->nama_produk ?? 'Belum ada data' }}
                    </h3>
                    @if ($produkterlaris)
                        <p class="text-xs text-amber-600 font-semibold mt-0.5">{{ $produkterlaris->total_terjual }} Pcs
                            terjual</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
