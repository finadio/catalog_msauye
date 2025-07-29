<x-guest-layout>
    {{-- Kontainer utama untuk halaman pending dengan desain yang konsisten --}}
    <div class="flex flex-col md:flex-row w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden my-8 transform transition-all duration-500">
        
        {{-- Panel kiri dengan informasi dan ilustrasi --}}
        <div class="md:w-1/2 bg-gradient-to-br from-yellow-400 via-orange-500 to-red-500 p-8 flex flex-col justify-center items-center text-white relative overflow-hidden">
            {{-- Background pattern --}}
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100" height="100" fill="url(#grid)" />
                </svg>
            </div>
            
            {{-- Konten panel kiri --}}
            <div class="relative z-10 text-center">
                <div class="mb-6">
                    {{-- Icon pending --}}
                    <div class="w-24 h-24 mx-auto bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold mb-2">Pendaftaran Berhasil!</h2>
                    <p class="text-lg opacity-90">Akun Anda sedang menunggu persetujuan admin</p>
                </div>
                
                <div class="space-y-3 text-sm opacity-80">
                    <p>✓ Data pendaftaran telah diterima</p>
                    <p>✓ Sedang dalam proses verifikasi</p>
                    <p>✓ Anda akan dihubungi setelah disetujui</p>
                </div>
            </div>
        </div>

        {{-- Panel kanan dengan informasi detail --}}
        <div class="md:w-1/2 p-8 flex flex-col justify-center">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Status Pendaftaran</h3>
                <div class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    Menunggu Persetujuan
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-blue-800">Informasi Penting</h4>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Proses verifikasi membutuhkan waktu 1-3 hari kerja</li>
                                    <li>Admin akan meninjau kelengkapan data UMKM Anda</li>
                                    <li>Pastikan informasi kontak yang diberikan aktif</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-2">Langkah Selanjutnya:</h4>
                    <ol class="list-decimal list-inside space-y-2 text-sm text-gray-600">
                        <li>Tunggu email konfirmasi dari admin</li>
                        <li>Siapkan dokumen pendukung jika diperlukan</li>
                        <li>Login setelah akun disetujui</li>
                    </ol>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('login') }}" class="flex-1 bg-blue-600 text-white text-center py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold">
                    Coba Login
                </a>
                <a href="{{ url('/') }}" class="flex-1 bg-gray-200 text-gray-800 text-center py-3 px-4 rounded-lg hover:bg-gray-300 transition duration-200 font-semibold">
                    Kembali ke Beranda
                </a>
            </div>

            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Butuh bantuan? Hubungi admin melalui:</p>
                <p class="font-medium text-gray-700">admin@example.com</p>
            </div>
        </div>
    </div>
</x-guest-layout>
