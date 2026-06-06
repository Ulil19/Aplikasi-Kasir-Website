@if (session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-4 shadow">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4 shadow">
        {{ session('error') }}
    </div>
@endif
