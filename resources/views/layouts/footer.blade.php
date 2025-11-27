    {{-- Footer Section --}}
    <footer class="bg-[#0B1120] text-white pt-20 pb-10 relative overflow-hidden font-sans border-t border-gray-800">
        {{-- Decorative Elements --}}
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
             style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 24px 24px;">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 mb-16">
                
                {{-- Brand Column (4 cols) --}}
                <div class="lg:col-span-4 space-y-6">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-900/20">
                            <i class='bx bxs-bank text-2xl'></i>
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold tracking-tight text-white">BPR MSA</h4>
                            <p class="text-xs text-gray-400 font-medium tracking-wider uppercase">Yogyakarta</p>
                        </div>
                    </div>
                    <p class="text-gray-400 leading-relaxed text-sm">
                        Mitra keuangan terpercaya yang menyediakan solusi permodalan bagi UMKM dan kebutuhan bisnis profesional Anda. Tumbuh bersama, sejahtera bersama.
                    </p>
                    
                    <div class="pt-4">
                        <h5 class="text-sm font-bold text-white mb-4">Ikuti Kami</h5>
                        <div class="flex gap-3">
                            <a href="https://www.instagram.com/bprmsa_official/" target="_blank" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:bg-pink-600 hover:text-white transition-all duration-300 hover:-translate-y-1 border border-white/5 hover:border-transparent">
                                <i class='bx bxl-instagram text-xl'></i>
                            </a>
                            <a href="https://web.facebook.com/bprmsa.official" target="_blank" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-all duration-300 hover:-translate-y-1 border border-white/5 hover:border-transparent">
                                <i class='bx bxl-facebook text-xl'></i>
                            </a>
                            <a href="https://www.tiktok.com/@bprmsa" target="_blank" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:bg-black hover:text-white transition-all duration-300 hover:-translate-y-1 border border-white/5 hover:border-gray-500">
                                <i class='bx bxl-tiktok text-xl'></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Quick Links (2 cols) --}}
                <div class="lg:col-span-2">
                    <h4 class="text-lg font-bold text-white mb-6 relative inline-block">
                        Menu Utama
                        <span class="absolute -bottom-2 left-0 w-12 h-1 bg-blue-600 rounded-full"></span>
                    </h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2 group">
                                <i class='bx bx-chevron-right text-blue-500 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300'></i>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('produk.index') }}" class="text-gray-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2 group">
                                <i class='bx bx-chevron-right text-blue-500 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300'></i>
                                Katalog Produk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('artikel.index') }}" class="text-gray-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2 group">
                                <i class='bx bx-chevron-right text-blue-500 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300'></i>
                                Artikel & Berita
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tentang') }}" class="text-gray-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2 group">
                                <i class='bx bx-chevron-right text-blue-500 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300'></i>
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="text-gray-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2 group">
                                <i class='bx bx-chevron-right text-blue-500 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300'></i>
                                Hubungi Kami
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Contact Info (3 cols) --}}
                <div class="lg:col-span-3">
                    <h4 class="text-lg font-bold text-white mb-6 relative inline-block">
                        Hubungi Kami
                        <span class="absolute -bottom-2 left-0 w-12 h-1 bg-blue-600 rounded-full"></span>
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shrink-0">
                                <i class='bx bx-map'></i>
                            </div>
                            <div>
                                <span class="block text-xs text-gray-500 font-bold uppercase tracking-wider mb-0.5">Alamat Kantor</span>
                                <p class="text-gray-400 text-sm leading-relaxed">Jalan C. Simanjuntak No. 26, Kota Yogyakarta 55223</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shrink-0">
                                <i class='bx bx-phone'></i>
                            </div>
                            <div>
                                <span class="block text-xs text-gray-500 font-bold uppercase tracking-wider mb-0.5">Telepon</span>
                                <p class="text-gray-400 text-sm">0274-549400</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shrink-0">
                                <i class='bx bx-envelope'></i>
                            </div>
                            <div>
                                <span class="block text-xs text-gray-500 font-bold uppercase tracking-wider mb-0.5">Email</span>
                                <p class="text-gray-400 text-sm">bprmadani@gmail.com</p>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Map (3 cols) --}}
                <div class="lg:col-span-3">
                    <h4 class="text-lg font-bold text-white mb-6 relative inline-block">
                        Lokasi
                        <span class="absolute -bottom-2 left-0 w-12 h-1 bg-blue-600 rounded-full"></span>
                    </h4>
                    <div class="w-full h-48 rounded-xl overflow-hidden shadow-lg border border-gray-800 relative group">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.103333946491!2d110.37076757439262!3d-7.778867192240737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5769f94c5885%3A0xeeffcc651da7e6d6!2sPT%20BPR%20Madani%20Sejahtera%20Abadi!5e0!3m2!1sen!2sid!4v1753067076562!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi BPR MSA Yogyakarta"
                            class="transition-all duration-500">
                        </iframe>
                        <div class="absolute inset-0 pointer-events-none border-4 border-gray-800/50 rounded-xl"></div>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-xs text-center md:text-left">
                    &copy; {{ date('Y') }} <span class="text-gray-300 font-semibold">PT BPR MSA Yogyakarta</span>. All rights reserved.
                    <span class="hidden sm:inline mx-2 text-gray-700">|</span>
                    <span class="block sm:inline mt-1 sm:mt-0">Terdaftar dan diawasi oleh <span class="font-semibold text-gray-400">OJK</span></span>
                </p>
                <div class="flex gap-6">
                    <a href="#" class="text-gray-500 hover:text-white text-xs transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-500 hover:text-white text-xs transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>