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

        <style>
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes fadeInRight {
                from { opacity: 0; transform: translateX(20px); }
                to { opacity: 1; transform: translateX(0); }
            }
            @keyframes fadeInLeft {
                from { opacity: 0; transform: translateX(-20px); }
                to { opacity: 1; transform: translateX(0); }
            }
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }
            .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
            .animate-fade-in-right { animation: fadeInRight 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
            .animate-fade-in-left { animation: fadeInLeft 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
            .animate-float { animation: float 6s ease-in-out infinite; }
            
            .delay-100 { animation-delay: 0.1s; opacity: 0; animation-fill-mode: forwards; }
            .delay-200 { animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards; }
            .delay-300 { animation-delay: 0.3s; opacity: 0; animation-fill-mode: forwards; }
            .delay-400 { animation-delay: 0.4s; opacity: 0; animation-fill-mode: forwards; }
            .delay-500 { animation-delay: 0.5s; opacity: 0; animation-fill-mode: forwards; }
            
            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: #f1f1f1; }
            ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
            ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        </style>
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
