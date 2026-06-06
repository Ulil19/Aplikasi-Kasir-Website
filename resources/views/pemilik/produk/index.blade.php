@extends('layouts.app')

@section('title', 'Kelola Produk')
@section('header', 'Kelola Data Produk')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div
            class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-100 bg-gray-50/50">
            <div>
                <h3 class="text-lg font-bold text-pos-dark tracking-tight">Daftar Produk</h3>
                <p class="text-xs text-gray-500 mt-0.5">Kelola data produk yang tersedia.</p>
            </div>
            <div class="flex shrink-0">
                <button data-modal-target="produkModal"
                    class="inline-flex items-center justify-center bg-pos-primary hover:bg-pos-primary/90 text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-all duration-200 shadow-sm cursor-pointer">
                    + Tambah Produk
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="border-b border-gray-100 text-xs font-semibold text-gray-400 uppercase tracking-wider bg-gray-50/30">
                        <th class="py-3 px-6 w-20">No</th>
                        <th class="py-3 px-6">Nama Produk</th>
                        <th class="py-3 px-6">Kategori</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-pos-dark">
                    @foreach ($produk as $item)
                        <tr class="hover:bg-gray-50/40 transition-colors">
                            <td class="py-4 px-6 font-medium text-gray-400">{{ $loop->iteration }}</td>
                            <td class="py-4 px-6 font-medium">{{ $item->nama }}</td>
                            <td class="py-4 px-6 font-medium">{{ $item->kategori->nama }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="#"
                                        class="bg-pos-success/10 hover:bg-pos-success text-pos-success hover:text-white text-xs font-semibold px-3 py-1.5 rounded-md transition-all">
                                        Edit
                                    </a>
                                    <a href="#"
                                        class="bg-pos-danger/10 hover:bg-pos-danger text-pos-danger hover:text-white text-xs font-semibold px-3 py-1.5 rounded-md transition-all">
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Produk --}}
    <div id="produkModal" class="modal hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="modal-close fixed inset-0 bg-gray-900/50 backdrop-blur-xs transition-opacity"></div>

            <div
                class="inline-block align-middle bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full z-10 border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 id="modalTitle" class="text-base font-bold text-pos-dark">Form Produk</h3>
                    <button class="modal-close text-gray-400 hover:text-gray-600 text-xl cursor-pointer">&times;</button>
                </div>
                <div class="p-6">
                    {{-- Konten Form --}}
                </div>
            </div>
        </div>
    </div>



@endsection
