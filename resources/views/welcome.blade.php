<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pengaduan Nasabah</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Tailwind CDN for development preview only (safe) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-r from-blue-100 via-indigo-100 to-purple-100 flex flex-col items-center justify-center text-gray-800 font-sans">

    <div class="w-full max-w-4xl p-8 bg-white shadow-xl rounded-xl border border-blue-100">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold mb-2 text-indigo-700">💬 Sistem Pengaduan Nasabah</h1>
            <p class="text-gray-600 text-lg">Silakan login sesuai peran Anda untuk mengelola atau menyampaikan pengaduan.</p>
        </div>

        <div class="flex flex-col md:flex-row justify-center gap-6">
            <a href="{{ route('login') }}" class="w-full md:w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-4 rounded-lg shadow-md text-center text-lg transition">
                🔐 Login Admin
            </a>
            <a href="{{ url('/login-nasabah') }}" class="w-full md:w-1/2 bg-green-600 hover:bg-green-700 text-white px-6 py-4 rounded-lg shadow-md text-center text-lg transition">
                🧑‍💼 Login Nasabah
            </a>
        </div>
    </div>

    <footer class="mt-10 text-sm text-gray-500">
        &copy; {{ date('Y') }} Sistem Informasi Pengaduan - Bank Fadhilah
    </footer>

</body>
</html>
