<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Selamat Datang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
            }
        </style>
    @endif
</head>
<body class="bg-gradient-to-r from-[#fdfdfc] to-[#f2f2f2] dark:from-[#0a0a0a] dark:to-[#1a1a1a] text-[#1b1b18] dark:text-white flex p-6 lg:p-8 items-center justify-center min-h-screen flex-col transition-all duration-500">

    <!-- Header -->
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="px-5 py-2 border border-[#19140035] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b] text-sm rounded-lg shadow-sm transition-all duration-300 hover:bg-[#f1f1f1] dark:hover:bg-[#1c1c1c]"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="px-5 py-2 border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] text-sm rounded-lg shadow-sm transition-all duration-300 hover:bg-[#f1f1f1] dark:hover:bg-[#1c1c1c]"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="px-5 py-2 border border-[#19140035] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b] text-sm rounded-lg shadow-sm transition-all duration-300 hover:bg-[#f1f1f1] dark:hover:bg-[#1c1c1c]"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Hero Content -->
    <div class="text-center mt-6">
        <div class="text-4xl font-bold mb-4 tracking-tight">
            Selamat Datang di Sistem Pengaduan Nasabah
        </div>
        <p class="text-gray-600 dark:text-gray-400 text-base max-w-xl mx-auto mb-8">
            Sistem ini memungkinkan nasabah untuk menyampaikan pengaduan dan mengevaluasi layanan bank dengan mudah dan cepat.
        </p>
        <div class="flex justify-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-[#1b1b18] text-white hover:bg-[#333] dark:bg-white dark:text-black dark:hover:bg-gray-300 px-6 py-2 rounded-lg shadow-md transition duration-300">
                        Masuk ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 text-white hover:bg-blue-700 px-6 py-2 rounded-lg shadow-md transition duration-300">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-gray-100 text-black hover:bg-gray-200 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 px-6 py-2 rounded-lg shadow-md transition duration-300">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

</body>
</html>
