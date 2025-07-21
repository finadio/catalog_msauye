<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Artikel & Edukasi</h1>
    </x-slot>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-10 md:mb-14 text-center leading-tight tracking-tight">Wawasan dan Inspirasi untuk UMKM</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                @forelse($articles ?? [] as $article)
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group transform hover:-translate-y-1">
                        @php
                            // Mengambil gambar berdasarkan tipe artikel, dengan fallback ke dummy jika tidak ditemukan
                            $articleImageMap = [
                                'edukasi' => 'artikel-edukasi.jpg',
                                'berita' => 'artikel-berita.jpg',
                                'default' => 'artikel-default.jpg', // Fallback umum
                            ];
                            $localImagePath = $articleImageMap[$article->type] ?? $articleImageMap['default'];
                        @endphp
                        <div class="relative overflow-hidden w-full aspect-video md:aspect-w-16 md:aspect-h-9">
                           <img src="{{ $article->photo ? asset('storage/'.$article->photo) : asset('img/' . $localImagePath) }}" 
                                alt="{{ $article->title }}" 
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                           <span class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full capitalize">
                                {{ $article->type }}
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="font-bold text-xl lg:text-2xl text-gray-900 leading-tight mb-3">{{ Str::limit($article->title, 70) }}</h3>
                            <p class="text-gray-700 text-sm md:text-base mb-4 flex-1 leading-relaxed">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                            <a href="{{ route('artikel.detail', $article->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base mt-auto justify-end transition-colors duration-200">
                                Baca Selengkapnya 
                                <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-12 text-lg">Belum ada artikel.</div>
                @endforelse
            </div>
            <div class="mt-12 flex justify-center">
                {{ $articles->links('vendor.pagination.modern') }}
            </div>
        </div>
    </div>

    {{-- Footer Section --}}
    <footer class="bg-gray-900 text-white py-10 md:py-12 mt-10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10 mb-8 md:mb-12">

                <div class="footer-section">
                    <div class="footer-logo mb-4">
                        <h4 class="text-xl md:text-2xl font-bold text-white mb-2">PT BPR MSA Yogyakarta</h4>
                    </div>
                    <p class="company-description text-gray-300 text-sm leading-relaxed mb-4">
                        Lembaga keuangan terpercaya yang menyediakan solusi permodalan bagi UMKM dan kebutuhan bisnis profesional Anda.
                    </p>
                    <div class="social-links flex gap-3 mt-4">
                        <a href="https://www.instagram.com/bprmsa.official/" target="_blank" aria-label="Instagram"
                           class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center text-white text-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1">
                            <i class='bx bxl-instagram'></i>
                        </a>
                        <a href="https://web.facebook.com/bprmsa.official" target="_blank" aria-label="Facebook"
                           class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center text-white text-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1">
                            <i class='bx bxl-facebook'></i>
                        </a>
                        <a href="https://wa.me/6285172024202" class="w-10 h-10 flex items-center justify-center rounded-full text-white bg-white/10 text-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1" title="WhatsApp" target="_blank" rel="noopener noreferrer"><i class='bx bxl-whatsapp'></i></a>
                        <a href="https://www.tiktok.com/@bprmsa" class="w-10 h-10 flex items-center justify-center rounded-full text-white bg-white/10 text-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1" title="TikTok" target="_blank" rel="noopener noreferrer"><i class='bx bxl-tiktok'></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4 class="text-lg md:text-xl font-semibold text-white mb-5 relative footer-heading-underline">Kontak Kami</h4>
                    <div class="contact-info flex flex-col gap-4">
                        <div class="contact-item flex items-start gap-3">
                            <i class='bx bxs-phone text-blue-400 text-xl flex-shrink-0 mt-0.5'></i>
                            <div>
                                <strong class="block text-white text-sm font-semibold mb-1">Telepon</strong>
                                <p class="text-gray-300 text-sm">0274-549400</p>
                            </div>
                        </div>
                        <div class="contact-item flex items-start gap-3">
                            <i class='bx bx-envelope text-blue-400 text-xl flex-shrink-0 mt-0.5'></i>
                            <div>
                                <strong class="block text-white text-sm font-semibold mb-1">Email</strong>
                                <p class="text-gray-300 text-sm">bprmadani@gmail.com</p>
                            </div>
                        </div>
                        <div class="contact-item flex items-start gap-3">
                            <i class='bx bx-globe text-blue-400 text-xl flex-shrink-0 mt-0.5'></i>
                            <div>
                                <strong class="block text-white text-sm font-semibold mb-1">Website</strong>
                                <p class="text-gray-300 text-sm">www.bprmsa.co.id</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-section">
                    <h4 class="text-lg md:text-xl font-semibold text-white mb-5 relative footer-heading-underline">Kantor Pusat</h4>
                    <div class="office-info mb-4">
                        <div class="address-info flex items-start gap-3">
                            <i class='bx bx-map-pin text-blue-400 text-xl flex-shrink-0 mt-0.5'></i>
                            <div>
                                <strong class="block text-white text-sm font-semibold mb-1">Alamat</strong>
                                <p class="text-gray-300 text-sm leading-relaxed">Jalan C. Simanjuntak No. 26<br>Kota Yogyakarta 55223</p>
                            </div>
                        </div>
                    </div>
                    <div class="map-container w-full h-40 rounded-xl overflow-hidden shadow-lg">
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

            <div class="border-t border-gray-700 py-6 mt-8 flex flex-col md:flex-row items-center justify-between gap-3">
                <p class="copyright text-gray-400 text-xs text-center md:text-left mb-0">
                    © {{ date('Y') }} PT BPR MSA Yogyakarta. All rights reserved.
                </p>
                <div class="footer-links flex gap-4 sm:gap-5 md:gap-6 justify-center">
                    <a href="{{ route('tentang') }}" class="text-gray-300 text-xs hover:text-white font-medium transition-colors duration-300">Tentang Kami</a>
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
        bottom: -6px;
        left: 0;
        width: 30px;
        height: 2px;
        background: linear-gradient(135deg, #3B82F6, #10B981);
        border-radius: 2px;
    }
    </style>
</x-app-layout>