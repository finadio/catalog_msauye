<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Daftar UMKM</h1>
    </x-slot>

    <div class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-10 md:mb-14 text-center leading-tight tracking-tight">Jelajahi UMKM Binaan Kami</h2>

            <form method="GET" action="{{ route('umkm.index') }}" class="mb-12 flex flex-col sm:flex-row flex-wrap justify-center items-center gap-4">
                <input type="text" name="q" placeholder="Cari UMKM..."
                       class="w-full sm:w-auto flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm text-gray-800 placeholder-gray-500"
                       value="{{ request('q') }}">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-lg transition duration-300 ease-in-out shadow-md transform hover:-translate-y-0.5">Cari</button>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($umkms as $umkm)
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden flex flex-col group transform hover:-translate-y-1">
                        <div class="relative overflow-hidden w-full aspect-video">
                            <img src="{{ $umkm->photo ? asset('storage/'.$umkm->photo) : asset('img/umkm-default.png') }}"
                                 alt="{{ $umkm->name }}"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="font-bold text-xl text-gray-900 leading-tight mb-3 truncate">{{ $umkm->name }}</h3>
                            <p class="text-gray-700 text-sm md:text-base mb-4 flex-1 leading-relaxed">{{ Str::limit($umkm->description, 100) }}</p>
                            <div class="text-gray-600 text-sm mb-4">
                                <p><span class="font-semibold">Alamat:</span> {{ Str::limit($umkm->address, 50) }}</p>
                                <p><span class="font-semibold">Telepon:</span> {{ $umkm->phone }}</p>
                            </div>
                            <a href="{{ route('umkm.detail', $umkm->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base mt-auto justify-end transition-colors duration-200">
                                Lihat Detail UMKM
                                <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-12 text-lg">Tidak ada UMKM ditemukan. Coba filter lain.</div>
                @endforelse
            </div>
            <div class="mt-12 flex justify-center">
                {{ $umkms->links() }}
            </div>
        </div>
    </div>

    {{-- Footer Section (copy from public/produk_index.blade.php or public/artikel.blade.php to maintain consistency) --}}
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