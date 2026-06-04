<header class="sticky top-0 z-10 flex justify-between items-center bg-white px-8 py-4 shadow-sm border-b border-gray-200">
    
    <div class="flex items-center space-x-4">
        <button id="sidebarToggle" class="text-gray-500 hover:text-blue-600 focus:outline-none transition-colors">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <div>
            <h2 class="text-xl font-bold text-gray-800 uppercase tracking-tight">@yield('header')</h2>
            <p class="text-xs text-gray-400 hidden sm:block">Kasir Sistem v1.0</p>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <div class="text-right hidden md:block">
            <p class="text-sm font-semibold text-gray-700 leading-none">{{ auth()->user()->name ?? 'User' }}</p>
            <span class="text-[10px] text-blue-500 font-bold uppercase">{{ auth()->user()->role ?? 'Role' }}</span>
        </div>
        <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold border-2 border-white shadow-sm">
            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
        </div>
    </div>
</header>