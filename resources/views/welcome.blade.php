<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Aplikasi Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="max-w-md w-full p-8 bg-white rounded-2xl shadow-xl border border-gray-100 text-center mx-4">
        <!-- Ikon atau Logo (Opsional) -->
        <div class="mb-6 flex justify-center">
            <div class="p-4 bg-blue-100 rounded-full text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            Selamat Datang
        </h1>
        <p class="text-gray-500 mb-8">
            Kelola transaksi dan inventaris Anda dengan lebih mudah dalam satu aplikasi.
        </p>
        <a href="/login"
            class="block w-full py-3 px-6 text-white bg-blue-600 hover:bg-blue-700 transition duration-200 rounded-xl font-semibold shadow-lg shadow-blue-200 uppercase tracking-wider text-sm">
            Lanjut untuk Login
        </a>
        <p class="mt-4 text-gray-400 text-sm">
            Belum Punya Akun? <a href="/contact" class="text-blue-600 hover:underline"> Hubungi Admin</a>
        </p>
        <p class="mt-8 text-xs text-gray-400">
            &copy; 2026 Aplikasi Kasir
        </p>
    </div>

</body>

</html>
