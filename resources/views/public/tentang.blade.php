<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Tentang Kami') }}
        </h1>
    </x-slot>

    {{-- Penambahan ruang di bawah header untuk pemisahan yang jelas --}}
    <div class="pt-8 md:pt-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 md:p-10 lg:p-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-12 md:mb-16 text-center leading-tight">Mengenal Lebih Dekat <br class="hidden md:inline">PT BPR MSA</h2>

            {{-- Bagian Visi --}}
            <section class="mb-12 md:mb-16 lg:mb-20">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-8 md:space-y-0 md:space-x-12">
                    <div class="w-full md:w-1/2 flex-shrink-0">
                        <img src="{{ asset('img/msa1.jpeg') }}" alt="Gedung BPR MSA" class="w-full h-auto object-cover rounded-lg shadow-xl">
                    </div>
                    <div class="w-full md:w-1/2 text-center md:text-left">
                        <h3 class="text-2xl lg:text-3xl font-bold text-blue-700 mb-4 md:mb-6">Visi Kami</h3>
                        <p class="text-gray-700 leading-relaxed text-base lg:text-lg">
                            Menjadi "Smart Banking" BPR terbaik di Indonesia.
                        </p>
                    </div>
                </div>
            </section>

            <hr class="border-gray-200 my-12 md:my-16">

            {{-- Bagian Misi --}}
            <section class="mb-12 md:mb-16 lg:mb-20">
                <div class="flex flex-col md:flex-row-reverse items-center md:items-start space-y-8 md:space-y-0 md:space-x-reverse md:space-x-12">
                    <div class="w-full md:w-1/2 flex-shrink-0">
                        <img src="{{ asset('img/timbpr.png') }}" alt="Tim BPR MSA" class="w-full h-auto object-cover rounded-lg shadow-xl">
                    </div>
                    <div class="w-full md:w-1/2 text-center md:text-right">
                        <h3 class="text-2xl lg:text-3xl font-bold text-green-700 mb-4 md:mb-6">Misi Kami</h3>
                        <ol class="list-decimal list-inside text-gray-700 leading-relaxed text-base lg:text-lg space-y-2 pl-4 md:pl-0">
                            <li>Terciptanya Good Corporate Governance, berbasis pada Perbankan yang sehat.</li>
                            <li>Menjalankan bisnis perbankan secara prudent (mengutamakan prinsip kehati-hatian) dengan tidak mengesampingkan pertumbuhan bisnis.</li>
                            <li>Menjadi partner bisnis bagi usaha mikro, kecil dan menengah untuk menunjang peningkatan ekonomi regional.</li>
                            <li>Memberikan pelayanan prima untuk memuaskan nasabah.</li>
                            <li>Memberikan keuntungan dan manfaat yang optimal kepada stake holder.</li>
                        </ol>
                    </div>
                </div>
            </section>

            <hr class="border-gray-200 my-12 md:my-16">

            {{-- Bagian Logo Besar BPR --}}
            <section class="mb-12 md:mb-16 lg:mb-20">
                <div class="text-center">
                    <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-8">Kami Adalah BPR MSA</h3>
                    <img src="{{ asset('img/msa.png') }}" alt="Logo Besar BPR MSA" class="mx-auto w-4/5 sm:w-3/5 md:w-1/2 lg:w-2/5">
                </div>
            </section>

            <hr class="border-gray-200 my-12 md:my-16">

            {{-- Bagian Hubungi Kami --}}
            <section class="pb-4">
                <div class="text-center md:text-left">
                    <h2 class="text-2xl lg:text-3xl font-bold mb-6 text-gray-900">Hubungi Kami</h2>
                    <p class="text-gray-700 leading-relaxed mb-8 text-base lg:text-lg">
                        Jika Anda memiliki pertanyaan lebih lanjut atau ingin menjadi bagian dari UMKM binaan kami, jangan ragu untuk menghubungi tim kami:
                    </p>
                    <div class="space-y-4">
                        <p class="text-gray-800 font-semibold text-lg lg:text-xl flex items-center justify-center md:justify-start">
                            <i class='bx bx-envelope mr-3 text-blue-600 text-2xl'></i> Email: <a href="mailto:bprmadani@gmail.com" class="text-blue-600 hover:underline ml-2">bprmadani@gmail.com</a>
                        </p>
                        <p class="text-gray-800 font-semibold text-lg lg:text-xl flex items-center justify-center md:justify-start">
                            <i class='bx bx-phone mr-3 text-blue-600 text-2xl'></i> Telepon: <a href="tel:0274-549400" class="text-blue-600 hover:underline ml-2">0274-549400</a>
                        </p>
                    </div>
                </div>
            </section>
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
                        <a href="https://www.tiktok.com/@bprmsa" target="_blank" aria-label="TikTok"
                           class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center text-white text-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1">
                            <i class='bx bxl-tiktok'></i>
                        </a>
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