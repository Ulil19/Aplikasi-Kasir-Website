@extends('layouts.app')

@section('title', 'Transaksi Kasir')
@section('header', 'Transaksi Kasir')

@section('content')
    <div class="flex flex-col lg:flex-row gap-5 items-start">
        <div class="w-full lg:flex-1 bg-white/90 rounded-lg shadow p-5">
            {{-- Search Bar --}}
            <div>
                <div class="flex gap-2 items-center mb-4">
                    <input type="text" id="search-input" placeholder="Cari kopi, makanan, atau snack..."
                        class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pos-accent" />
                </div>
            </div>

            <div class="mb-5">
                <div class="flex gap-2 w-full overflow-x-auto whitespace-nowrap pb-2 scrollbar-none">
                    <div data-kategori="all"
                        class="category-pill rounded-full border border-pos-primary py-1 px-4 text-center text-sm transition-all shadow-sm bg-pos-primary text-white cursor-pointer">
                        Semua
                    </div>
                    @foreach ($kategori as $k)
                        <div data-kategori="{{ $k->nama }}"
                            class="category-pill rounded-full border border-pos-primary py-1 px-4 text-center text-sm transition-all shadow-sm text-pos-dark hover:bg-pos-primary hover:text-white cursor-pointer">
                            {{ $k->nama }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="max-h-[calc(100vh-280px)] overflow-y-auto pr-2">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach ($kategori as $kat)
                        @foreach ($kat->produk as $produk)
                            <div class="produk-card border border-pos-dark rounded-xl shadow-sm p-3 flex flex-col justify-between bg-white"
                                data-kategori="{{ $kat->nama }}" data-nama="{{ $produk->nama }}">
                                <div>
                                    <div
                                        class="w-full h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                                            class="object-cover w-full h-full" />
                                    </div>
                                    <div class="mt-3">
                                        <p class="uppercase text-pos-accent text-[10px] font-bold tracking-wider">
                                            {{ $kat->nama }}
                                        </p>
                                        <h3 class="text-pos-dark font-semibold text-sm line-clamp-2 mt-0.5">
                                            {{ $produk->nama }}
                                        </h3>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-3 pt-2 border-t border-gray-50">
                                    <span class="text-pos-success text-base font-bold">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                    {{-- Button Tambah ke Keranjang --}}
                                    <button id="add-to-cart-{{ $produk->id }}"
                                        class="w-8 h-8 rounded-full bg-pos-primary flex items-center justify-center shadow text-white hover:bg-pos-accent transition-colors"
                                        data-nama="{{ $produk->nama }}" data-harga="{{ $produk->harga }}"
                                        data-id="{{ $produk->id }}"
                                        data-gambar="{{ asset('storage/' . $produk->gambar) }}"
                                        data-kategori="{{ $kat->nama }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 17h-11v-14h-2" />
                                            <path d="M6 5l14 1l-1 7h-13" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar Keranjang --}}
        <aside class="w-full lg:w-96 bg-white rounded-lg shadow flex flex-col sticky top-5 h-[calc(100vh-120px)]">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-base font-bold flex items-center gap-2 text-pos-dark">
                    <span class="p-2 bg-pos-primary/10 text-pos-primary rounded-lg text-sm">🛒</span>
                    Keranjang Belanja
                </h2>
                <span id="cart-count" class="text-xs bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full font-semibold">0
                    Item</span>
            </div>
            <div id="cart-items" class="flex-1 overflow-y-auto p-4 space-y-3 min-h-62.5">
                {{-- ketika keranjang kosong --}}
                <div id="cart-empty"
                    class="text-center py-12 text-gray-400 flex flex-col items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300" width="40" height="40"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" />
                    </svg>
                    <p class="text-sm">Belum ada produk dipilih</p>
                </div>
            </div>

            {{-- Bagian Total Tagihan & Aksi --}}
            <div class="p-4 border-t border-gray-100 bg-gray-50/50 rounded-b-lg">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm text-gray-500 font-medium">Total Tagihan</span>
                    <span id="cart-total" class="text-lg font-bold text-pos-primary">Rp 0</span>
                </div>
                <button id="checkout-btn"
                    class="w-full bg-pos-primary hover:bg-pos-accent text-white font-bold py-3 rounded-xl transition-all active:scale-[0.98] shadow-sm flex justify-center items-center gap-2">
                    Bayar Sekarang (<span id="cart-count-bottom">0</span> Item)
                </button>
            </div>
        </aside>

    </div>
@endsection
