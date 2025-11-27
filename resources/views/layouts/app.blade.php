<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MSAcata') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    {{-- Menggunakan satu import Poppins dengan bobot yang dibutuhkan --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    {{-- Tambahkan import Boxicons di sini --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <main>
            {{ $slot }}
        </main>

        @include('layouts.footer')
    </div>
</body>

</html>