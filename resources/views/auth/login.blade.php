<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Login | Aplikasi Kasir</title>
</head>

<body class="bg-pos-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-xl shadow-pos-dark/5 border border-gray-100 overflow-hidden">

            <div class="pt-10 pb-6 text-center">
                <div class="inline-flex p-4 bg-pos-primary/10 rounded-2xl mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pos-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-extrabold text-pos-dark tracking-tight">Selamat Datang Kembali</h2>
                <p class="text-sm text-gray-400 mt-1">Silakan masuk ke akun Anda</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="p-8 pt-0 space-y-5">
                @csrf

                <div>
                    <label for="email"
                        class="block text-xs font-bold text-pos-dark uppercase tracking-wider mb-2 ms-1">Email</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" required placeholder="nama@email.com"
                            class="block w-full px-4 py-3.5 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-pos-primary/20 focus:bg-white transition-all duration-200 text-sm placeholder:text-gray-300">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2 ms-1">
                        <label for="password"
                            class="block text-xs font-bold text-pos-dark uppercase tracking-wider">Password</label>
                        <a href="#"
                            class="text-xs font-semibold text-pos-accent hover:text-pos-primary transition-colors">Lupa
                            Password?</a>
                    </div>
                    <input type="password" name="password" id="password" required placeholder="••••••••"
                        class="block w-full px-4 py-3.5 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-pos-primary/20 focus:bg-white transition-all duration-200 text-sm placeholder:text-gray-300">
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 bg-pos-primary hover:bg-pos-dark text-white rounded-2xl font-bold shadow-lg shadow-pos-primary/20 transition-all duration-300 transform active:scale-[0.98] tracking-wide text-sm">
                        MASUK SEKARANG
                    </button>
                </div>

                <div class="text-center text-sm text-gray-400">
                    Kembali ke <a href="/" class=" text-pos-dark hover:underline">Halaman Utama</a>
                </div>

            </form>
        </div>

        <p class="mt-4 text-gray-400 text-center text-sm">
            Belum Punya Akun? <a href="/contact" class="text-pos-primary hover:underline"> Hubungi Admin</a>
        </p>
    </div>
</body>

</html>
