<x-app-layout>
    {{-- Hero Section --}}
    <section class="relative bg-black h-[550px] md:h-[650px] flex items-center justify-center text-white overflow-hidden">
        {{-- Gambar latar belakang dari aset lokal --}}
        <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('img/hero.png') }}');"></div>
        <div class="absolute inset-0 bg-gray-900 opacity-60 z-10"></div> {{-- Overlay abu-abu gelap transparan --}}

        <div class="max-w-4xl mx-auto text-center relative z-20 px-6 py-10">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 tracking-tight drop-shadow-lg">
                Gerbang Digital UMKM Binaan <br class="hidden md:inline">PT BPR MSA
            </h1>
            <p class="text-base sm:text-lg md:text-xl mb-10 leading-relaxed text-gray-200 drop-shadow-md">
                Jelajahi koleksi produk dan layanan berkualitas tinggi dari para pelaku UMKM lokal terkemuka.
                Dukung pertumbuhan ekonomi daerah dengan setiap klik dan eksplorasi Anda!
            </p>
            <a href="#produk-terbaru" class="inline-block px-12 py-4 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 font-bold text-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                Jelajahi Produk UMKM
            </a>
        </div>
    </section>

    {{-- Feature Section (Keunggulan PT BPR MSA) --}}
    <section class="py-12 md:py-14 bg-gray-50"> {{-- Padding dikurangi: py-12 md:py-16 --}}
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 text-center">
            <div class="flex flex-col items-center p-8 bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1">
                <div class="p-4 bg-blue-100 rounded-full mb-5 shadow-inner">
                    <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Promosi Digital Efektif</h3>
                <p class="text-gray-600 leading-relaxed text-sm">Meningkatkan visibilitas dan jangkauan produk UMKM melalui platform online modern.</p>
            </div>
            <div class="flex flex-col items-center p-8 bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1">
                <div class="p-4 bg-green-100 rounded-full mb-5 shadow-inner">
                    <svg class="w-9 h-9 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.105A9.702 9.702 0 0112 4c4.97 0 9 3.582 9 8z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Edukasi & Pendampingan Holistik</h3>
                <p class="text-gray-600 leading-relaxed text-sm">Memberikan pengetahuan dan bimbingan komprehensif untuk pengembangan usaha.</p>
            </div>
            <div class="flex flex-col items-center p-8 bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1">
                <div class="p-4 bg-yellow-100 rounded-full mb-5 shadow-inner">
                    <svg class="w-9 h-9 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Akses Permodalan Fleksibel</h3>
                <p class="text-gray-600 leading-relaxed text-sm">Memfasilitasi akses mudah ke sumber permodalan yang sesuai dengan kebutuhan UMKM.</p>
            </div>
        </div>
    </section>

    {{-- Category Section (Scrollable Cards - Revised) --}}
    <section class="py-8 md:py-10 bg-gray-100"> {{-- Padding dikurangi: py-12 md:py-16 --}}
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-10 text-center">Jelajahi Berdasarkan Kategori Produk</h2>
            <div class="overflow-x-auto pb-6 custom-scrollbar-hide">
                <div class="flex space-x-4 sm:space-x-6 md:space-x-8 px-4 sm:px-6 lg:px-8 -ml-4 sm:-ml-6 lg:-ml-8 min-w-max"> {{-- Penyesuaian margin/padding untuk konsistensi --}}
                    @forelse($categories as $cat)
                        <a href="{{ route('home', ['kategori' => $cat->id]) }}" class="flex-none w-44 sm:w-52 md:w-60 flex flex-col bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 group overflow-hidden">
                            @php
                                $categoryImageMap = [
                                    'Makanan' => 'makanan.jpg',
                                    'Minuman' => 'minuman.jpg',
                                    'Kerajinan' => 'kerajinan.jpg',
                                    'Jasa' => 'jasa.jpg',
                                    'Fashion' => 'fashion.jpg',
                                    'Kesehatan' => 'kesehatan.jpg',
                                    'Elektronik' => 'elektronik.jpg',
                                    'Rumah Tangga' => 'rumahtangga.jpg',
                                ];
                                $localImagePath = $categoryImageMap[$cat->name] ?? 'category-default.jpg';
                            @endphp
                            <div class="w-full h-40 sm:h-48 md:h-56 overflow-hidden rounded-t-xl"> {{-- Tinggi gambar lebih besar --}}
                                <img src="{{ asset('img/' . $localImagePath) }}" alt="Kategori {{ $cat->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-4 flex flex-col items-center text-center flex-grow">
                                <h4 class="font-semibold text-lg text-gray-800 group-hover:text-blue-600 transition-colors duration-300">{{ $cat->name }}</h4>
                            </div>
                        </a>
                    @empty
                        <div class="text-center text-gray-500 w-full py-12">Belum ada kategori.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- Flexible Section (Berita & Artikel Terbaru) --}}
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-10 text-center">Wawasan Terbaru dari Blog Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                @forelse($articles->take(3) as $article)
                    <div class="bg-gray-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden flex flex-col">
                        @php
                            $articleImageMap = [
                                'edukasi' => 'artikel-edukasi.jpg',
                                'berita' => 'artikel-berita.jpg',
                                'default' => 'artikel-default.jpg',
                            ];
                            $localImagePath = $articleImageMap[$article->type] ?? $articleImageMap['default'];
                        @endphp
                        <img src="{{ $article->photo ? asset('storage/'.$article->photo) : asset('img/' . $localImagePath) }}" alt="{{ $article->title }}" class="w-full h-48 md:h-56 object-cover transform group-hover:scale-105 transition-transform duration-300">
                        <div class="p-6 flex-1 flex flex-col">
                            <span class="text-blue-600 text-sm font-semibold capitalize mb-2">{{ $article->type }}</span>
                            <h3 class="font-bold text-xl text-gray-900 leading-tight mb-3">{{ Str::limit($article->title, 70) }}</h3>
                            <p class="text-gray-700 text-sm md:text-base mb-4 flex-1 leading-relaxed">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                            <a href="{{ route('artikel.detail', $article->id) }}" class="text-blue-600 hover:underline font-semibold text-base flex items-center justify-end">Baca Selengkapnya <span class="ml-1">→</span></a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-12 text-lg">Belum ada berita atau artikel terbaru.</div>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('artikel.index') }}" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 font-semibold transition duration-300 shadow-md">Lihat Semua Artikel</a>
            </div>
        </div>
    </section>

    {{-- Product Cards Section --}}
    <div class="py-12 md:py-16 bg-gray-50" id="produk-terbaru">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-10 text-center">Temukan Produk UMKM Unggulan</h2>
            <form method="GET" action="{{ route('home') }}" class="mb-12 flex flex-col sm:flex-row flex-wrap justify-center items-center gap-4">
                <input type="text" name="q" placeholder="Cari produk..." class="w-full sm:w-auto flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm text-gray-800 placeholder-gray-500">
                <select name="kategori" class="w-full sm:w-auto flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm text-gray-800">
                    <option value="">Semua Kategori</option>
                    @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" @selected(request('kategori') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-lg transition duration-300 ease-in-out shadow-md">Cari</button>
            </form>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
                @forelse($products ?? [] as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col group">
                        <div class="relative overflow-hidden w-full aspect-square">
                            @php
                                $productDummyImages = [
                                    'produk-dummy-1.jpg',
                                    'produk-dummy-2.jpg',
                                    'produk-dummy-3.jpg',
                                    'produk-dummy-4.jpg',
                                    'produk-dummy-5.jpg',
                                    'produk-dummy-6.jpg',
                                ];
                                $localDummyImagePath = $productDummyImages[$loop->index % count($productDummyImages)];
                            @endphp
                            <img src="{{ $product->photo ? asset('storage/'.$product->photo) : asset('img/' . $localDummyImagePath) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105">
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
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.111860293233!2d110.37525381477797!3d-7.777080694086657!2m3!1f0!2m3!1f0!2m3!1f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57700e3f28f5%3A0xc48c03e3a4e9b921!2sPT%20BPR%20MSA%20Yogyakarta!5e0!3m2!1sen!2sid!4v1678891234567!5m2!1sen!2sid"
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

            <div class="border-t border-gray-700 py-5 mt-8 flex flex-col md:flex-row items-center justify-between gap-2"> {{-- **Padding vertikal dan margin atas pembatas dikurangi** --}}
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