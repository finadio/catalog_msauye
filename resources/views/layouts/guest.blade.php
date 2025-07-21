<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Umkm_Katalog') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        {{-- Mengubah font dari Figtree ke Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        {{-- Boxicons for icons --}}
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    {{-- Mengubah latar belakang body menjadi polos --}}
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        {{-- Kontainer utama yang akan menampung konten login/register --}}
        {{-- Menambahkan min-h-screen untuk memastikan tinggi penuh viewport --}}
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-6 sm:py-0">
            {{-- Slot untuk konten halaman autentikasi (login/register) --}}
            {{ $slot }}
        </div>
    </body>
</html>
