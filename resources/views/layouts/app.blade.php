<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Kasir App')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-pos-bg">

    <div id="sidebar-overlay"
        class="fixed inset-0 bg-gray-900/50 z-30 hidden transition-opacity lg:hidden backdrop-blur-sm"></div>

    @include('layouts.partials._wrapper')

    <div id="main-content" class="flex flex-col min-h-screen transition-all duration-300 ease-in-out ml-0 lg:ml-64">

        @include('layouts.partials.topbar')

        <main class="flex-1 p-3">
            <div class="animate-fade-in">
                @yield('content')
                @include('layouts.partials.alerts')
            </div>
        </main>

    </div>

</body>

</html>
