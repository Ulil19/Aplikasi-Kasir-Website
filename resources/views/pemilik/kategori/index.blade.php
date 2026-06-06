@extends('layouts.app')

@section('title', 'Kelola Kategori')
@section('header', 'Kelola Data Kategori')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div
            class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-100 bg-gray-50/50">
            <div>
                <h3 class="text-lg font-bold text-pos-dark tracking-tight">Daftar Kategori</h3>
                <p class="text-xs text-gray-500 mt-0.5">Kelola data kategori yang tersedia.</p>
            </div>
            <div class="flex shrink-0">
                <button data-modal-target="kategoriModal" data-mode="create"
                    class="inline-flex items-center justify-center bg-pos-primary hover:bg-pos-primary/90 text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-all duration-200 shadow-sm cursor-pointer">
                    + Tambah Kategori
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="border-b border-gray-100 text-xs font-semibold text-gray-400 uppercase tracking-wider bg-gray-50/30">
                        <th class="py-3 px-6 w-20">No</th>
                        <th class="py-3 px-6">Nama Kategori</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-pos-dark">
                    @foreach ($kategori as $item)
                        <tr class="hover:bg-gray-50/40 transition-colors">
                            <td class="py-4 px-6 font-medium text-gray-400">{{ $loop->iteration }}</td>
                            <td class="py-4 px-6 font-medium">{{ $item->nama }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="#" data-modal-target="kategoriModal" data-mode="edit"
                                        data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                        data-deskripsi="{{ $item->deskripsi }}"
                                        class="bg-pos-success/10 hover:bg-pos-success text-pos-success hover:text-white text-xs font-semibold px-3 py-1.5 rounded-md transition-all">
                                        Edit
                                    </a>
                                    <form action="{{ route('pemilik.kategori.hapus', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Kategori --}}
    <div id="kategoriModal" class="modal hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="modal-close fixed inset-0 bg-gray-900/50 backdrop-blur-xs transition-opacity"></div>

            <div
                class="inline-block align-middle bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full z-10 border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 id="modalTitle" class="text-base font-bold text-pos-dark">Form Kategori</h3>
                    <button class="modal-close text-gray-400 hover:text-gray-600 text-xl cursor-pointer">&times;</button>
                </div>
                <div class="p-6">
                    {{-- Konten Form --}}
                    <form id="kategoriForm" action="{{ route('pemilik.kategori.simpan') }}" method="POST"
                        class="space-y-4">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <input type="hidden" name="id" id="kategoriId">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                            <input type="text" name="nama" id="nama" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-pos-primary focus:border-pos-primary sm:text-sm">
                        </div>
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-pos-primary focus:border-pos-primary sm:text-sm"></textarea>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
