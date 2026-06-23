@extends('layouts.app')

@section('title', 'Detail Transaksi')
@section('header', 'Detail Transaksi')

@section('content')
    <div class="bg-white/90 rounded-xl border border-gray-200 shadow-sm overflow-hidden">

        {{-- 1. Header Utama (Warna Gelap/Brand) --}}
        <div class="bg-pos-primary text-white p-4">
            <h3 class="text-lg font-bold tracking-wide">Detail Transaksi</h3>
        </div>

        {{-- 2. Konten Detail Transaksi --}}
        <div class="p-4">
            <div class="mb-4">
                <p class="text-sm text-gray-600">Invoice: <span
                        class="font-semibold text-gray-800">{{ $transaksi->invoice }}</span></p>
                <p class="text-sm text-gray-600">Kustomer: <span
                        class="font-semibold text-gray-800">{{ $transaksi->customer }}</span></p>
                <p class="text-sm text-gray-600">Tanggal: <span
                        class="font-semibold text-gray-800">{{ $transaksi->created_at->format('d M Y H:i') }}</span></p>
            </div>

            {{-- Tabel Detail Produk --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Produk</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Harga</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jumlah</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($transaksi->details as $index => $detail)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $detail->nama_produk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Rp
                                    {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $detail->jumlah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Rp
                                    {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Ringkasan Total --}}
            <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex justify-between mb-2">
                    <span class="text-sm text-gray-600">Total:</span>
                    <span class="font-semibold text-gray-900">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-sm text-gray-600">Bayar:</span>
                    <span class="font-semibold text-gray-900">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Kembalian:</span>
                    <span class="font-semibold text-gray-900">Rp
                        {{ number_format($transaksi->kembalian, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- 3. Tombol Kembali --}}
        <div class="p-4 border-t border-gray-200">
            <a href="{{ route('pemilik.transaksi') }}"
                class="inline-block bg-pos-primary text-white px-4 py-2 rounded-lg shadow hover:bg-pos-accent transition-colors">Kembali</a>
        </div>


    </div>
@endsection
