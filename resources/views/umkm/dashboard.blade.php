<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard UMKM
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Navigasi Menu -->
            <div class="flex justify-between items-center mb-6">
                <div class="space-x-4">
                    <a href="{{ route('umkm.produk.index') }}" class="text-blue-600 hover:underline">Kelola Produk</a>
                    <a href="{{ route('umkm.profil') }}" class="text-blue-600 hover:underline">Edit Profil</a>
                </div>

                <!-- Foto & Dropdown -->
                <div class="relative">
                    <button class="flex items-center space-x-2">
                        <img src="https://ui-avatars.com/api/?name=UMKM&background=random" class="w-8 h-8 rounded-full" />
                        <span>{{ Auth::user()->name }}</span>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded shadow z-50">
                        <a href="{{ route('profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Status Produk -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Status Produk</h3>
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr>
                                <th class="py-2 text-left">Nama Produk</th>
                                <th class="py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-t">
                                    <td class="py-2">{{ $product->name }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 rounded-full text-xs
                                            {{ $product->status === 'Aktif' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $product->status === 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $product->status === 'Ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                            {{ $product->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            @if($products->isEmpty())
                                <tr><td colspan="2" class="py-4 text-center text-gray-500">Belum ada produk</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
