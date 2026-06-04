<p class="text-xs text-slate-500 uppercase font-semibold mb-4 ml-2">Menu Utama</p>

<a href="{{ route('pemilik.dashboard') }}"
    class="flex items-center p-3 mb-2 {{ request()->routeIs('pemilik.dashboard') ? 'bg-blue-800 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-home mr-3 w-5 text-center"></i> Dashboard
</a>

<p class="text-xs text-slate-500 uppercase font-semibold mt-6 mb-4 ml-2">Master Data</p>

<a href="/kategori"
    class="flex items-center p-3 mb-2 {{ request()->is('kategori*') ? 'bg-blue-800 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-tags mr-3 w-5 text-center"></i> Kategori
</a>

<a href="/produk"
    class="flex items-center p-3 mb-2 {{ request()->is('produk*') ? 'bg-blue-800 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-box mr-3 w-5 text-center"></i> Produk
</a>

<p class="text-xs text-slate-500 uppercase font-semibold mt-6 mb-4 ml-2">Penjualan</p>

<a href="/transaksi"
    class="flex items-center p-3 mb-2 {{ request()->is('transaksi*') ? 'bg-blue-800 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-cash-register mr-3 w-5 text-center"></i> Transaksi
</a>

<a href="/riwayat-penjualan"
    class="flex items-center p-3 mb-2 {{ request()->is('riwayat-penjualan*') ? 'bg-blue-800 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-history mr-3 w-5 text-center"></i> Riwayat Penjualan
</a>

<a href="/laporan"
    class="flex items-center p-3 mb-2 {{ request()->is('laporan*') ? 'bg-blue-800 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-chart-line mr-3 w-5 text-center"></i> Laporan
</a>

<p class="text-xs text-slate-500 uppercase font-semibold mt-6 mb-4 ml-2">Pengaturan</p>

<a href="/staff"
    class="flex items-center p-3 mb-2 {{ request()->is('staff*') ? 'bg-blue-800 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-users mr-3 w-5 text-center"></i> Manajemen Staff
</a>

<a href="/profile"
    class="flex items-center p-3 mb-2 {{ request()->is('profile') ? 'bg-blue-800 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fas fa-user mr-3 w-5 text-center"></i> Profile
</a>
