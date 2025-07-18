<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Detail UMKM') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Bagian Detail UMKM --}}
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 flex flex-col md:flex-row gap-8 mb-8">
            <div class="flex-shrink-0 w-full md:w-1/3 rounded-lg overflow-hidden shadow-md">
                <img src="{{ $umkm->photo ? asset('storage/'.$umkm->photo) : asset('img/umkm-default.jpg') }}" alt="{{ $umkm->name }}" class="w-full h-56 md:h-72 object-cover">
            </div>
            <div class="flex-1 flex flex-col">
                <h2 class="text-3xl font-bold mb-3 text-gray-900">{{ $umkm->name }}</h2>
                <p class="mb-6 text-gray-700 leading-relaxed">{{ $umkm->description }}</p>
                <div class="space-y-2 text-gray-600 text-sm mb-4">
                    <p><span class="font-semibold">Alamat:</span> {{ $umkm->address }}</p>
                    <p><span class="font-semibold">Telepon:</span> {{ $umkm->phone }}</p>
                </div>

                <div class="mb-6">
                    <div class="text-sm text-gray-600 font-semibold mb-2">Kontak & Media Sosial:</div>
                    <div class="flex flex-col gap-2">
                        @if($umkm->whatsapp)
                            <a href="https://wa.me/{{ $umkm->whatsapp }}" target="_blank" class="flex items-center text-green-600 hover:text-green-700 font-medium">
                                <i class='bx bxl-whatsapp text-lg mr-2'></i> WhatsApp: {{ $umkm->whatsapp }}
                            </a>
                        @endif
                        @if($umkm->instagram)
                            {{-- HAPUS @ DI SINI --}}
                            <a href="https://instagram.com/{{ $umkm->instagram }}" target="_blank" class="flex items-center text-pink-600 hover:text-pink-700 font-medium">
                                <i class='bx bxl-instagram text-lg mr-2'></i> Instagram: {{ $umkm->instagram }}
                            </a>
                        @endif
                        {{-- Field TikTok --}}
                        @if($umkm->tiktok)
                            {{-- HAPUS @ DI SINI --}}
                            <a href="https://tiktok.com/@{{ $umkm->tiktok }}" target="_blank" class="flex items-center text-gray-800 hover:text-gray-900 font-medium">
                                <i class='bx bxl-tiktok text-lg mr-2'></i> TikTok: {{ $umkm->tiktok }}
                            </a>
                        @endif
                        {{-- Field Website --}}
                        @if($umkm->website)
                            <a href="{{ $umkm->website }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-700 font-medium">
                                <i class='bx bx-globe text-lg mr-2'></i> Website: {{ $umkm->website }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Bagian Produk UMKM --}}
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Produk UMKM</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Foto</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($umkm->products as $product)
                            <tr class="hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ $product->photo ? asset('storage/'.$product->photo) : 'https://via.placeholder.com/80x60?text=Foto' }}" class="h-12 w-16 object-cover rounded shadow-sm"/>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($product->price,0,',','.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($product->status->name == 'approved') bg-green-100 text-green-800
                                        @elseif($product->status->name == 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($product->status->name) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-lg">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada produk untuk UMKM ini.</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        UMKM ini belum menambahkan produk ke katalog.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>