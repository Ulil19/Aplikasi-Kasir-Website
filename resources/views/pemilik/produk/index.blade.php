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
                        <th class="py-3 px-6">Deskripsi</th>
                        <th class="py-3 px-6">Harga</th>
                        <th class="py-3 px-6">Gambar</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-pos-dark">
                    @if ($kategori->pluck('produk')->collapse()->isEmpty())
                        <tr class="hover:bg-gray-50/40 transition-colors">
                            <td colspan="7" class="py-4 px-6 text-center text-gray-400 italic">
                                Tidak ada data produk yang tersedia.
                            </td>
                        </tr>
                    @else
                        @foreach ($kategori as $kat)
                            @foreach ($kat->produk as $prod)
                                <tr class="hover:bg-gray-50/40 transition-colors">
                                    <td class="py-4 px-6 font-medium text-gray-400">
                                        {{ $loop->parent->iteration * $loop->iteration }}</td>
                                    <td class="py-4 px-6 font-medium">{{ $prod->nama }}</td>
                                    <td class="py-4 px-6 font-medium">{{ $kat->nama }}</td>
                                    <td class="py-4 px-6">{{ $prod->deskripsi }}</td>
                                    <td class="py-4 px-6 font-medium">Rp {{ number_format($prod->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if ($prod->gambar)
                                            <img src="{{ asset('storage/' . $prod->gambar) }}" alt="{{ $prod->nama }}"
                                                class="w-16 h-16 object-cover rounded-md">
                                        @else
                                            <span class="text-gray-400">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="#" data-modal-target="produkModal" data-mode="edit"
                                                data-id="{{ $prod->id }}" data-nama="{{ e($prod->nama) }}"
                                                data-kategori_id="{{ $prod->kategori_id }}"
                                                data-deskripsi="{{ e($prod->deskripsi) }}"
                                                data-harga="{{ $prod->harga }}" data-gambar="{{ $prod->gambar }}"
                                                class="bg-pos-success/10 hover:bg-pos-success text-pos-success hover:text-white text-xs font-semibold px-3 py-1.5 rounded-md transition-all">
                                                Edit
                                            </a>
                                            <form action="{{ route('pemilik.produk.hapus', $prod->id) }}" method="POST"
                                                class="form-delete">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-pos-danger/10 hover:bg-pos-danger text-pos-danger hover:text-white text-xs font-semibold px-3 py-1.5 rounded-md transition-all">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
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
                    <h3 id="modalTitleProduk" class="text-base font-bold text-pos-dark">Form Produk</h3>
                    <button class="modal-close text-gray-400 hover:text-gray-600 text-xl cursor-pointer">&times;</button>
                </div>
                <div class="p-6">
                    {{-- Konten Form --}}
                    <form id="produkForm" action="{{ route('pemilik.produk.simpan') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="formMethodProduk" value="POST">
                        <input type="hidden" id="produkId" name="produk_id">

                        <div>
                            <label for="namaProduk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                            <input type="text" name="nama" id="namaProduk" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-pos-primary focus:border-pos-primary sm:text-sm">
                        </div>
                        <div>
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori_id" id="kategori_id" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-pos-primary focus:border-pos-primary sm:text-sm">
                                <option disabled selected>Pilih Kategori</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="deskripsiProduk" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsiProduk" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-pos-primary focus:border-pos-primary sm:text-sm"></textarea>
                        </div>

                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" name="harga" id="harga" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-pos-primary focus:border-pos-primary sm:text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Gambar</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="image-upload"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Unggah file</span>
                                            <input id="image-upload" name="gambar" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1 text-gray-500">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG sampai 2MB</p>
                                </div>
                            </div>

                            <p id="file-name" class="text-sm text-gray-500 mt-2 italic"></p>

                            @error('gambar')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button"
                                class="modal-close bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold px-4 py-2 rounded-md transition-all">
                                Batal
                            </button>
                            <button type="submit"
                                class="bg-pos-primary hover:bg-pos-primary/90 text-white text-sm font-semibold px-4 py-2 rounded-md transition-all">
                                Simpan
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
