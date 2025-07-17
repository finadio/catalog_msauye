<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard UMKM
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Selamat datang di Dashboard UMKM</h1>
                <p class="text-gray-700">Halo, {{ Auth::user()->name }}!</p>
            </div>
        </div>
    </div>
</x-app-layout>
