@extends('layouts.app')

@section('title', 'Laporan Pemilik')
@section('header', 'Laporan Pemilik')

@section('content')
    <div class="space-y-6">
        {{-- Bar Filter & Export --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4">
            <form action="{{ request()->url() }}" method="GET"
                class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex flex-wrap items-center gap-4 text-gray-700">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <label for="start_date"
                            class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Dari:</label>
                        <input type="date" name="start_date" id="start_date"
                            value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}"
                            class="bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-pos-accent text-gray-800" />
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <label for="end_date"
                            class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Sampai:</label>
                        <input type="date" name="end_date" id="end_date"
                            value="{{ request('end_date', now()->format('Y-m-d')) }}"
                            class="bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-pos-accent text-gray-800" />
                    </div>
                    <button type="submit"
                        class="bg-pos-primary hover:bg-opacity-90 text-white px-4 py-1.5 rounded-lg text-sm font-semibold transition-all shadow-sm">
                        Filter Laporan
                    </button>
                </div>

                <div class="flex items-center gap-2">
                    <input type="hidden" name="action" id="form-action" value="">
                    <button type="submit" onclick="document.getElementById('form-action').value='excel'"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-1.5 rounded-lg text-sm font-semibold transition-all shadow-sm flex items-center gap-1">
                        <span>Export Excel</span>
                    </button>
                    <button type="submit" onclick="document.getElementById('form-action').value='pdf'"
                        class="bg-rose-600 hover:bg-rose-700 text-white px-4 py-1.5 rounded-lg text-sm font-semibold transition-all shadow-sm flex items-center gap-1">
                        <span>Export PDF</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Kartu Ringkasan Finansial (Widget) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center space-x-4">
                <div class="p-3 bg-sky-100 text-sky-600 rounded-lg">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Omzet</p>
                    <h3 class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center space-x-4">
                <div class="p-3 bg-emerald-100 text-emerald-600 rounded-lg">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Transaksi</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalTransaksi }} Nota</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center space-x-4">
                <div class="p-3 bg-amber-100 text-amber-600 rounded-lg">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Item Terjual</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalItemTerjual }} Pcs</h3>
                </div>
            </div>
        </div>

        {{-- Area Grafik --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Grafik Tren Omzet Penjualan</h3>
            <div class="h-80 relative">
                <canvas id="omzetChart" data-chart="{{ json_encode($dataGrafik) }}"></canvas>
            </div>
        </div>

        {{-- Grid Kolom: Produk Terlaris & Performa Kasir --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Sisi Kiri: 5 Produk Terlaris --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                        <svg class="h-5 w-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        5 Produk Terlaris Periode Ini
                    </h3>
                    <span class="text-xs font-medium text-gray-400">Berdasarkan Qty</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <th class="px-4 py-2">Nama Produk</th>
                                <th class="px-4 py-2 text-center">Terjual</th>
                                <th class="px-4 py-2 text-right">Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            @forelse($produkTerlaris as $produk)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $produk->nama_produk }}</td>
                                    <td class="px-4 py-3 text-center font-semibold text-sky-600">
                                        {{ $produk->total_terjual }} Pcs</td>
                                    <td class="px-4 py-3 text-right">Rp
                                        {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-6 text-center text-gray-400 text-xs">Belum ada data
                                        penjualan pada tanggal ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Sisi Kanan: Performa Kasir --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                        <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        Performa Penjualan Kasir
                    </h3>
                    <span class="text-xs font-medium text-gray-400">Periode Ini</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <th class="px-4 py-2">Nama Staff / Kasir</th>
                                <th class="px-4 py-2 text-center">Melayani</th>
                                <th class="px-4 py-2 text-right">Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            @forelse($performaKasir as $kasir)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        {{ $kasir->user->nama ?? 'Kasir Dihapus' }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="px-2 py-0.5 bg-slate-100 text-slate-700 rounded text-xs font-semibold">
                                            {{ $kasir->total_transaksi }} Nota
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right font-bold text-emerald-600">
                                        Rp {{ number_format($kasir->total_omzet, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-6 text-center text-gray-400 text-xs">Tidak ada
                                        aktivitas kasir pada tanggal ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
