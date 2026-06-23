@extends('layouts.app')

@section('title', 'Transaksi Pemilik')
@section('header', 'Transaksi Pemilik')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="bg-pos-primary text-white p-4">
            <h3 class="text-lg font-bold tracking-wide">Kelola Transaksi</h3>
        </div>
        <div class="bg-gray-50 border-b border-gray-200 p-4">
            <form action="{{ request()->url() }}" method="GET"
                class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex flex-wrap items-center gap-4 text-gray-700">
                    {{-- Filter Tanggal Mulai --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <label for="start_date"
                            class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Dari:</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-pos-accent text-gray-800" />
                    </div>
                    {{-- Filter Tanggal Akhir --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <label for="end_date"
                            class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Sampai:</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                            class="bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-pos-accent text-gray-800" />
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <label for="sort"
                            class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Urutan:</label>
                        <select name="sort" id="sort"
                            class="bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-pos-accent text-gray-800">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Total Terbesar
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2 lg:w-auto w-full">
                    {{-- Input Cari --}}
                    <div class="relative flex-1 lg:flex-none">
                        <input type="text" name="cari" id="cari" placeholder="Cari invoice / kustomer..."
                            value="{{ request('cari') }}"
                            class="w-full lg:w-48 bg-white border border-gray-300 rounded-lg pl-3 pr-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-pos-accent text-gray-800" />
                    </div>
                    <input type="hidden" name="action" id="form-action" value="">
                    <button type="submit" onclick="document.getElementById('form-action').value=''"
                        class="bg-pos-primary hover:bg-opacity-90 text-white px-3 py-1.5 rounded-lg text-sm font-semibold transition-all shadow-sm">
                        Terapkan
                    </button>
                    {{-- Tombol Export Excel --}}
                    <button type="submit" onclick="document.getElementById('form-action').value='excel'"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-sm font-semibold transition-all shadow-sm flex items-center gap-1">
                        <span>Excel</span>
                    </button>
                    {{-- Tombol Export PDF --}}
                    <button type="submit" onclick="document.getElementById('form-action').value='pdf'"
                        class="bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 rounded-lg text-sm font-semibold transition-all shadow-sm flex items-center gap-1">
                        <span>PDF</span>
                    </button>
                    @if (request()->hasAny(['start_date', 'end_date', 'sort', 'cari']))
                        <a href="{{ request()->url() }}"
                            class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-600 px-3 py-1.5 rounded-lg text-sm font-medium transition-all shadow-sm">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Tabel Transaksi --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Invoice
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Kustomer</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Bayar
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Kembalian</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($transaksi as $index => $trx)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $trx->invoice }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trx->customer }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Rp
                                {{ number_format($trx->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp
                                {{ number_format($trx->bayar, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp
                                {{ number_format($trx->kembalian, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $trx->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('pemilik.transaksi.detail', $trx->id) }}"
                                    class="text-pos-primary hover:text-pos-accent font-semibold transition-colors">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-sm text-gray-400">
                                <svg class="mx-auto h-10 w-10 text-gray-300 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                Tidak ada data transaksi yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if (method_exists($transaksi, 'links'))
            <div class="p-4 bg-white border-t border-gray-200">
                {{ $transaksi->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
