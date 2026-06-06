<p class="text-xs text-stone-100 uppercase font-semibold mb-4 ml-2">Menu Utama</p>

<a href="{{ route('pemilik.dashboard') }}"
    class="flex items-center p-3 mb-2 {{ request()->routeIs('pemilik.dashboard') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-stone-600' }} rounded-lg transition">
    <i class="fa fa-home mr-3 w-5 text-center"></i> Dashboard
</a>

<p class="text-xs text-stone-100 uppercase font-semibold mt-6 mb-4 ml-2">Master Data</p>

<a href="{{ route('pemilik.kategori') }}"
    class="flex items-center p-3 mb-2 {{ request()->routeIs('pemilik.kategori') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fa fa-tags mr-3 w-5 text-center"></i> Kategori
</a>

<a href="{{ route('pemilik.produk') }}"
    class="flex items-center p-3 mb-2 {{ request()->routeIs('pemilik.produk') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fa fa-box mr-3 w-5 text-center"></i> Produk
</a>

<p class="text-xs text-stone-100 uppercase font-semibold mt-6 mb-4 ml-2">Penjualan</p>

<a href="/transaksi"
    class="flex items-center p-3 mb-2 {{ request()->is('transaksi*') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fa fa-cash-register mr-3 w-5 text-center"></i> Transaksi
</a>

<a href="/riwayat-penjualan"
    class="flex items-center p-3 mb-2 {{ request()->is('riwayat-penjualan*') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fa fa-history mr-3 w-5 text-center"></i> Riwayat Penjualan
</a>

<a href="/laporan"
    class="flex items-center p-3 mb-2 {{ request()->is('laporan*') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fa fa-chart-line mr-3 w-5 text-center"></i> Laporan
</a>

<p class="text-xs text-stone-100 uppercase font-semibold mt-6 mb-4 ml-2">Pengaturan</p>

<a href="/staff"
    class="flex items-center p-3 mb-2 {{ request()->is('staff*') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fa fa-users mr-3 w-5 text-center"></i> Manajemen Staff
</a>

<a href="/profile"
    class="flex items-center p-3 mb-2 {{ request()->is('profile') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-slate-800' }} rounded-lg transition">
    <i class="fa fa-user mr-3 w-5 text-center"></i> Profile
</a>
