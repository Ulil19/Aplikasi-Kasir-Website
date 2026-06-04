<p class="text-xs text-slate-500 uppercase font-semibold mb-4 ml-2">Menu Kasir</p>

<a href="/dashboard"
    class="flex items-center p-3 mb-2 {{ request()->is('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-home mr-3 w-5 text-center"></i> Dashboard
</a>

<a href="{{ route('kasir.transaksi') }}"
    class="flex items-center p-3 mb-2 {{ request()->is('kasir/transaksi') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-shopping-cart mr-3 w-5 text-center"></i> Kasir / Transaksi
</a>

<a href="/riwayat"
    class="flex items-center p-3 mb-2 {{ request()->is('riwayat*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-history mr-3 w-5 text-center"></i> Riwayat Transaksi
</a>

<div class="mt-4 border-t border-slate-800 pt-6">
    <a href="/profile"
        class="flex items-center p-3 mb-2 {{ request()->is('profile') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
        <i class="fas fa-user mr-3 w-5 text-center"></i> Profile
    </a>
</div>
