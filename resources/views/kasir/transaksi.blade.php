@extends('layouts.app')

@section('title', 'Transaksi Kasir')
@section('header', 'Transaksi Kasir')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Fitur transaksi kasir akan segera hadir. Mohon bersabar!</p>

        <div class="flex items-center justify-center h-screen">
            <div class="w-80 border border-blue-200 rounded-lg shadow-md p-4">
                <!-- Product Image -->
                <div>
                    <Image src="https://primecomputer.com.bd/wp-content/uploads/2024/07/oraimo-headphones.jpg"
                        alt="Product Image" class="object-contain w-full h-67.5 fill" />
                </div>
            </div>

            <!-- Product Details -->
            <div class="mt-4">
                <h3 class="text-gray-800 font-medium text-base">
                    Kopi Susu Gula Aren 250ml
                </h3>
                <p class="uppercase text-green-600 text-xs font-medium">
                    Minuman
                </p>
                <!-- Pricing -->
                <div class="flex items-end justify-between">
                    <div class="flex items-baseline space-x-2 mt-2">
                        <span class="text-blue-600 text-xl font-semibold">Rp 25.000</span>
                    </div>
                    <button class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center shadow text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M17 17h-11v-14h-2" />
                            <path d="M6 5l14 1l-1 7h-13" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
