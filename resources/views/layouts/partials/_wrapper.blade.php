<aside id="sidebar"
    class="fixed inset-y-0 left-0 w-64 bg-slate-900 text-white shadow-xl flex flex-col transition-transform duration-300 ease-in-out transform translate-x-0 z-40">
    <div class="flex items-center justify-center h-20 border-b border-slate-800 shrink-0">
        <h1 class="text-xl font-bold tracking-wider uppercase">Kasir <span class="text-blue-500">App</span></h1>
    </div>

    <nav
        class="flex-1 px-4 py-6 overflow-y-auto [&::-webkit-scrollbar]:hidden [&::-webkit-scrollbar-track]:hidden [&::-webkit-scrollbar-thumb]:hidden [-ms-overflow-style:none]">
        @if (auth()->user()->role === 'pemilik')
            @include('layouts.partials._pemilik')
        @else
            @include('layouts.partials._kasir')
        @endif
    </nav>

    <div class="w-full p-4 border-t border-slate-800 bg-slate-900 shrink-0">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center w-full p-3 text-red-400 hover:bg-red-900/20 rounded-lg transition">
                <i class="fas fa-sign-out-alt mr-3"></i> Keluar
            </button>
        </form>
    </div>

</aside>
