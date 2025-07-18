<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Produk UMKM</h1>
    </x-slot>

    <div class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-10 md:mb-14 text-center leading-tight tracking-tight">Jelajahi Produk UMKM Unggulan Kami</h2>

            <form method="GET" action="{{ route('produk.index') }}" class="mb-12 flex flex-col sm:flex-row flex-wrap justify-center items-center gap-4">
                <input type="text" name="q" placeholder="Cari produk..." 
                       class="w-full sm:w-auto flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm text-gray-800 placeholder-gray-500"
                       value="{{ request('q') }}">
                <select name="kategori" class="w-full sm:w-auto flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm text-gray-800">
                    <option value="">Semua Kategori</option>
                    @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" @selected(request('kategori') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-lg transition duration-300 ease-in-out shadow-md transform hover:-translate-y-0.5">Cari</button>
            </form>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
                @forelse($products ?? [] as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col group">
                        <div class="relative overflow-hidden w-full aspect-square">
                            @php
                                // Array of dummy product images for fallback
                                $productDummyImages = [
                                    'produk-dummy-1.jpg',
                                    'produk-dummy-2.jpg',
                                    'produk-dummy-3.jpg',
                                    'produk-dummy-4.jpg',
                                    'produk-dummy-5.jpg',
                                    'produk-dummy-6.jpg',
                                ];
                                // Use product photo if available, otherwise use a dummy image based on loop index
                                $localDummyImagePath = $productDummyImages[$loop->index % count($productDummyImages)];
                            @endphp
                            <img src="{{ Str::startsWith($product->photo, 'produk-dummy') ? asset('img/' . $product->photo) : asset('storage/' . $product->photo) }}" 
                                alt="{{ $product->name }}" 
                                class="absolute inset-0 w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105">
                            @if($product->status->name != 'approved')
                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-md z-10">
                                    {{ ucfirst($product->status->name) }}
                                </span>
                            @endif
                        </div>
                        <div class="p-3 flex-1 flex flex-col">
                            <h4 class="font-semibold text-sm mb-1 text-gray-800 leading-tight truncate">{{ $product->name }}</h4>
                            <div class="text-blue-600 font-bold text-base mb-2">Rp {{ number_format($product->price,0,',','.') }}</div>
                            <div class="text-gray-500 text-xs mb-3 truncate">UMKM: {{ $product->umkm->name ?? '-' }}</div>
                            <a href="{{ route('produk.detail', $product->id) }}" class="mt-auto block text-center px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 font-semibold text-sm transition duration-300">Detail</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-12 text-lg">Produk tidak ditemukan. Coba filter lain.</div>
                @endforelse
            </div>
            <div class="mt-12 flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    {{-- Footer Section --}}
    <footer class="bg-gray-900 text-white py-10 md:py-12 mt-10"> {{-- **Padding dan margin atas dikurangi** --}}
        <div class="max-w-7xl mx-auto px-4"> {{-- Container utama footer --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-8 md:mb-10"> {{-- **Gap antar kolom dikurangi** --}}

                <div class="footer-section">
                    <div class="footer-logo mb-3"> {{-- **Margin bawah logo dikurangi** --}}
                        <h4 class="text-xl md:text-2xl font-bold text-white mb-1">PT BPR MSA Yogyakarta</h4> {{-- **Ukuran font judul dikurangi** --}}
                    </div>
                    <p class="company-description text-gray-300 text-sm leading-relaxed mb-3"> {{-- **Margin bawah deskripsi dikurangi** --}}
                        Lembaga keuangan terpercaya yang menyediakan solusi permodalan bagi UMKM dan kebutuhan bisnis profesional Anda.
                    </p>
                    <div class="social-links flex gap-2 mt-3"> {{-- **Gap ikon sosial dikurangi** --}}
                        <a href="https://www.instagram.com/bprmsa.official/" target="_blank" aria-label="Instagram"
                           class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center text-white text-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1"> {{-- **Ukuran ikon sosial dikurangi** --}}
                            <i class='bx bxl-instagram'></i>
                        </a>
                        <a href="https://web.facebook.com/bprmsa.official" target="_blank" aria-label="Facebook"
                           class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center text-white text-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1">
                            <i class='bx bxl-facebook'></i>
                        </a>
                        <a href="https://www.tiktok.com/@bprmsa" target="_blank" aria-label="TikTok"
                           class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center text-white text-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1">
                            <i class='bx bxl-tiktok'></i>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4 class="text-lg md:text-xl font-semibold text-white mb-4 relative footer-heading-underline">Kontak Kami</h4> {{-- **Ukuran font judul dikurangi** --}}
                    <div class="contact-info flex flex-col gap-3"> {{-- **Gap antar item kontak dikurangi** --}}
                        <div class="contact-item flex items-start gap-2"> {{-- **Gap ikon dan teks dikurangi** --}}
                            <i class='bx bxs-phone text-blue-400 text-xl flex-shrink-0 mt-0.5'></i> {{-- **Ukuran ikon dikurangi** --}}
                            <div>
                                <strong class="block text-white text-sm font-semibold mb-0.5">Telepon</strong> {{-- **Margin dan ukuran font dikurangi** --}}
                                <p class="text-gray-300 text-sm">0274-549400</p>
                            </div>
                        </div>
                        <div class="contact-item flex items-start gap-2">
                            <i class='bx bx-envelope text-blue-400 text-xl flex-shrink-0 mt-0.5'></i>
                            <div>
                                <strong class="block text-white text-sm font-semibold mb-0.5">Email</strong>
                                <p class="text-gray-300 text-sm">bprmadani@gmail.com</p>
                            </div>
                        </div>
                        <div class="contact-item flex items-start gap-2">
                            <i class='bx bx-globe text-blue-400 text-xl flex-shrink-0 mt-0.5'></i>
                            <div>
                                <strong class="block text-white text-sm font-semibold mb-0.5">Website</strong>
                                <p class="text-gray-300 text-sm">www.bprmsa.co.id</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-section">
                    <h4 class="text-lg md:text-xl font-semibold text-white mb-4 relative footer-heading-underline">Kantor Pusat</h4> {{-- **Ukuran font judul dikurangi** --}}
                    <div class="office-info mb-4"> {{-- **Margin bawah info kantor dikurangi** --}}
                        <div class="address-info flex items-start gap-2">
                            <i class='bx bx-map-pin text-blue-400 text-xl flex-shrink-0 mt-0.5'></i>
                            <div>
                                <strong class="block text-white text-sm font-semibold mb-0.5">Alamat</strong>
                                <p class="text-gray-300 text-sm leading-relaxed">Jalan C. Simanjuntak No. 26<br>Kota Yogyakarta 55223</p>
                            </div>
                        </div>
                    </div>
                    <div class="map-container w-full h-40 rounded-xl overflow-hidden shadow-lg"> {{-- **Tinggi iframe peta dikurangi** --}}
                        <iframe
                            src="http://googleusercontent.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.250567083049!2d110.3752538147775!3d-7.75971939441113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59929d20c57f%3A0x86f345c26b52a514!2sPT.%20BPR%20MSA%20Yogyakarta!5e0!3m2!1sen!2sid!4v1678250000000!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi BPR MSA Yogyakarta">
                        </iframe>
                    </div>
                </div>

            </div>

            <div class="border-t border-gray-700 py-5 mt-8 flex flex-col md:flex-row items-center justify-between gap-4 px-4"> {{-- **Padding vertikal dan margin atas pembatas dikurangi** --}}
                <p class="copyright text-gray-400 text-xs text-center md:text-left mb-0"> {{-- **Ukuran font hak cipta dikurangi** --}}
                    © {{ date('Y') }} PT BPR MSA Yogyakarta. All rights reserved.
                </p>
                <div class="footer-links flex gap-3 sm:gap-4 md:gap-5 justify-center"> {{-- **Gap tautan footer dikurangi** --}}
                    <a href="{{ route('tentang') }}" class="text-gray-300 text-xs hover:text-white font-medium transition-colors duration-300">Tentang Kami</a> {{-- **Ukuran font tautan dikurangi** --}}
                    <a href="{{ route('artikel.index') }}" class="text-gray-300 text-xs hover:text-white font-medium transition-colors duration-300">Artikel</a>
                    <a href="{{ route('contact') }}" class="text-gray-300 text-xs hover:text-white font-medium transition-colors duration-300">Kontak</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Custom CSS untuk pseudo-element ::after pada judul footer --}}
    <style>
    .footer-heading-underline::after {
        content: '';
        position: absolute;
        bottom: -6px; /* Jarak dari teks dikurangi */
        left: 0;
        width: 30px; /* Lebar garis bawah dikurangi */
        height: 2px; /* Tinggi garis bawah dikurangi */
        background: linear-gradient(135deg, #3B82F6, #10B981); /* Warna gradien biru-hijau */
        border-radius: 2px;
    }

    /* Memastikan custom-scrollbar-hide tetap ada */
    .custom-scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .custom-scrollbar-hide {
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    </style>
</x-app-layout>