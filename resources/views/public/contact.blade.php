<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Hubungi Kami</h1>
    </x-slot>

    <div class="py-5 bg-gray-100 min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl w-full bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-1/2 p-6 md:p-8 flex flex-col justify-center bg-gray-50">
                    <h2 class="text-3xl font-extrabold text-blue-900 mb-6 leading-tight">Hubungi Kami</h2>
                    <div class="space-y-4 text-gray-700 text-base">
                        <div class="flex items-start">
                            <div class="w-9 h-9 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center text-xl flex-shrink-0 mr-3">
                                <i class='bx bx-map'></i>
                            </div>
                            <div>
                                <b class="font-semibold text-gray-800">Alamat:</b> Jalan C. Simanjuntak No. 26, Kota Yogyakarta 55223
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-9 h-9 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center text-xl flex-shrink-0 mr-3">
                                <i class='bx bx-phone'></i>
                            </div>
                            <div>
                                <b class="font-semibold text-gray-800">Telepon:</b> 0274-549400
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-9 h-9 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center text-xl flex-shrink-0 mr-3">
                                <i class='bx bxl-whatsapp'></i>
                            </div>
                            <div>
                                <b class="font-semibold text-gray-800">WhatsApp Business:</b> 0851-7202-4202
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-9 h-9 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center text-xl flex-shrink-0 mr-3">
                                <i class='bx bx-envelope'></i>
                            </div>
                            <div>
                                <b class="font-semibold text-gray-800">Email:</b> bprmadani@gmail.com
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-9 h-9 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center text-xl flex-shrink-0 mr-3">
                                <i class='bx bx-time'></i>
                            </div>
                            <div>
                                <b class="font-semibold text-gray-800">Jam Operasional:</b> Senin–Jumat: 08.00–17.00
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center gap-3">
                        <a href="https://instagram.com/bprmsa.official" class="w-10 h-10 flex items-center justify-center rounded-full text-blue-900 bg-gray-100 border border-gray-200 text-2xl shadow-sm hover:bg-gray-200 hover:text-blue-700 transform hover:scale-110 transition-all duration-200" title="Instagram" target="_blank" rel="noopener noreferrer"><i class='bx bxl-instagram'></i></a>
                        <a href="https://facebook.com/bprmsa.official" class="w-10 h-10 flex items-center justify-center rounded-full text-blue-900 bg-gray-100 border border-gray-200 text-2xl shadow-sm hover:bg-gray-200 hover:text-blue-700 transform hover:scale-110 transition-all duration-200" title="Facebook" target="_blank" rel="noopener noreferrer"><i class='bx bxl-facebook'></i></a>
                        <a href="https://wa.me/6285172024202" class="w-10 h-10 flex items-center justify-center rounded-full text-blue-900 bg-gray-100 border border-gray-200 text-2xl shadow-sm hover:bg-gray-200 hover:text-blue-700 transform hover:scale-110 transition-all duration-200" title="WhatsApp" target="_blank" rel="noopener noreferrer"><i class='bx bxl-whatsapp'></i></a>
                        <a href="https://twitter.com/bprmsa" class="w-10 h-10 flex items-center justify-center rounded-full text-blue-900 bg-gray-100 border border-gray-200 text-2xl shadow-sm hover:bg-gray-200 hover:text-blue-700 transform hover:scale-110 transition-all duration-200" title="Twitter" target="_blank" rel="noopener noreferrer"><i class='bx bxl-twitter'></i></a>
                        <a href="https://youtube.com/@bprmsa" class="w-10 h-10 flex items-center justify-center rounded-full text-blue-900 bg-gray-100 border border-gray-200 text-2xl shadow-sm hover:bg-gray-200 hover:text-blue-700 transform hover:scale-110 transition-all duration-200" title="YouTube" target="_blank" rel="noopener noreferrer"><i class='bx bxl-youtube'></i></a>
                        <a href="https://tiktok.com/@bprmsa" class="w-10 h-10 flex items-center justify-center rounded-full text-blue-900 bg-gray-100 border border-gray-200 text-2xl shadow-sm hover:bg-gray-200 hover:text-blue-700 transform hover:scale-110 transition-all duration-200" title="TikTok" target="_blank" rel="noopener noreferrer"><i class='bx bxl-tiktok'></i></a>
                    </div>
                </div>

                <div class="w-full md:w-1/2 p-6 md:p-8 relative">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Kirim Pesan Anda</h2>
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg text-center font-medium shadow-sm">{{ session('success') }}</div>
                    @endif
                    <form method="POST" action="{{ route('contact') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 font-semibold text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500 transition-colors duration-200" placeholder="Nama Lengkap" required value="{{ old('name') }}">
                            @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 font-semibold text-gray-700">Alamat Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500 transition-colors duration-200" placeholder="Alamat Email" required value="{{ old('email') }}">
                            @error('email')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="subject" class="block mb-2 font-semibold text-gray-700">Subjek Pesan</label>
                            <select id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 transition-colors duration-200" required>
                                <option value="">Pilih Subjek</option>
                                <option value="informasi_produk" {{ old('subject') == 'informasi_produk' ? 'selected' : '' }}>Informasi Produk</option>
                                <option value="kerjasama_umkm" {{ old('subject') == 'kerjasama_umkm' ? 'selected' : '' }}>Kerja Sama UMKM</option>
                                <option value="bantuan_umum" {{ old('subject') == 'bantuan_umum' ? 'selected' : '' }}>Bantuan Umum</option>
                                <option value="lainnya" {{ old('subject') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('subject')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="message" class="block mb-2 font-semibold text-gray-700">Isi Pesan</label>
                            <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500 transition-colors duration-200" placeholder="Tulis pesan Anda di sini..." required>{{ old('message') }}</textarea>
                            @error('message')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-lg transition duration-300 shadow-md transform hover:-translate-y-0.5">Kirim Pesan</button>
                    </form>
                </div>
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
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.103333946491!2d110.37076757439262!3d-7.778867192240737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5769f94c5885%3A0xeeffcc651da7e6d6!2sPT%20BPR%20Madani%20Sejahtera%20Abadi!5e0!3m2!1sen!2sid!4v1753067076562!5m2!1sen!2sid"
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