<x-app-layout>
    {{-- Hero Section --}}
    <div class="relative bg-slate-900 pt-40 pb-20 lg:pt-52 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('img/msa1.jpeg') }}" class="w-full h-full object-cover" alt="Background">
            <div class="absolute inset-0 bg-slate-900 mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
                Mengenal Lebih Dekat <br class="hidden md:inline"><span class="text-blue-400">PT BPR MSA</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
                Mitra perbankan terpercaya yang berkomitmen untuk pertumbuhan ekonomi regional dan kesuksesan UMKM di
                Indonesia.
            </p>

        </div>
    </div>

    {{-- Main Content --}}
    <div class="bg-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Visi Section --}}
            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-20 mb-24">
                <div class="w-full md:w-1/2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('img/msa1.jpeg') }}" alt="Gedung BPR MSA"
                            class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div
                        class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-blue-50 text-blue-700 font-semibold text-sm mb-6 border border-blue-100">
                        Visi Kami
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 leading-tight">Menjadi <span
                            class="text-blue-700">Smart Banking</span> BPR Terbaik di Indonesia</h2>
                    <p class="text-lg text-slate-600 leading-relaxed mb-8">
                        Kami bertekad untuk terus berinovasi dan memberikan layanan perbankan yang cerdas, efisien, dan
                        terpercaya bagi seluruh masyarakat, mendukung pertumbuhan ekonomi yang berkelanjutan.
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="h-px w-12 bg-blue-600"></div>
                        <span class="text-slate-500 font-medium tracking-wide uppercase text-sm">PT BPR MSA</span>
                    </div>
                </div>
            </div>

            {{-- Misi Section --}}
            <div class="flex flex-col md:flex-row-reverse items-center gap-12 lg:gap-20 mb-24">
                <div class="w-full md:w-1/2">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('img/timbpr.png') }}" alt="Tim BPR MSA"
                            class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div
                        class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-green-50 text-green-700 font-semibold text-sm mb-6 border border-green-100">
                        Misi Kami
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 leading-tight">Komitmen Pelayanan &
                        Tata Kelola</h2>
                    <ul class="space-y-5">
                        <li class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class='bx bx-check text-green-600 text-xl'></i>
                            </div>
                            <span class="text-slate-700 text-lg">Menciptakan <strong>Good Corporate Governance</strong>
                                berbasis perbankan yang sehat.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class='bx bx-check text-green-600 text-xl'></i>
                            </div>
                            <span class="text-slate-700 text-lg">Menjalankan bisnis secara <strong>prudent</strong>
                                dengan prinsip kehati-hatian.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class='bx bx-check text-green-600 text-xl'></i>
                            </div>
                            <span class="text-slate-700 text-lg">Menjadi partner bisnis strategis bagi
                                <strong>UMKM</strong>.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class='bx bx-check text-green-600 text-xl'></i>
                            </div>
                            <span class="text-slate-700 text-lg">Memberikan pelayanan prima untuk kepuasan
                                nasabah.</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Identity Section --}}
            <div class="bg-slate-50 rounded-3xl p-12 lg:p-16 text-center border border-slate-100">
                <h3 class="text-2xl font-bold text-slate-900 mb-8">Identitas Kami</h3>
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('img/msa.png') }}" alt="Logo BPR MSA" class="h-24 md:h-32 object-contain">
                </div>
                <p class="text-slate-600 max-w-2xl mx-auto text-lg leading-relaxed">
                    BPR MSA hadir sebagai solusi keuangan yang dekat dan mengerti kebutuhan Anda. Kami tumbuh bersama
                    masyarakat Yogyakarta dan sekitarnya.
                </p>
            </div>

            {{-- CTA Section --}}
            <div class="mt-24 text-center">
                <h2 class="text-3xl font-bold text-slate-900 mb-6">Siap Bermitra dengan Kami?</h2>
                <p class="text-slate-600 text-lg mb-8 max-w-2xl mx-auto">
                    Hubungi kami untuk informasi lebih lanjut mengenai produk dan layanan kami.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-blue-700 text-white font-semibold rounded-xl hover:bg-blue-800 transition-colors shadow-lg shadow-blue-700/20">
                        Hubungi Kami
                    </a>
                    <a href="mailto:bprmadani@gmail.com"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white text-slate-700 font-semibold rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                        <i class='bx bx-envelope mr-2 text-xl'></i> Kirim Email
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>