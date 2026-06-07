<p class="text-xs text-stone-100 uppercase font-semibold mb-4 ml-2">Menu Kasir</p>

<a href="{{ route('kasir.transaksi') }}"
    class="flex items-center p-3 mb-2 {{ request()->is('kasir/transaksi') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-stone-600' }} rounded-lg transition">
    <i class="fas fa-shopping-cart mr-3 w-5 text-center"></i> Kasir
</a>

<div class="mt-4 border-t border-slate-800 pt-6">
    <a href="/profile"
        class="flex items-center p-3 mb-2 {{ request()->is('profile') ? 'bg-pos-accent text-white' : 'text-stone-100 hover:text-white hover:bg-stone-600' }} rounded-lg transition">
        <i class="fas fa-user mr-3 w-5 text-center"></i> Profile
    </a>
</div>
