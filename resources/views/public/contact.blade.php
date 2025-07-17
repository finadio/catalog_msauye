<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Hubungi Kami</h1>
    </x-slot>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 text-center">Kirim Pesan Anda</h2>
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg text-center font-medium">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('contact') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block mb-2 font-semibold text-gray-700">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800" required value="{{ old('name') }}">
                    @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="email" class="block mb-2 font-semibold text-gray-700">Alamat Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800" required value="{{ old('email') }}">
                    @error('email')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="subject" class="block mb-2 font-semibold text-gray-700">Subjek Pesan</label>
                    <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800" required value="{{ old('subject') }}">
                    @error('subject')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="message" class="block mb-2 font-semibold text-gray-700">Isi Pesan</label>
                    <textarea id="message" name="message" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800" required>{{ old('message') }}</textarea>
                    @error('message')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-lg transition duration-300 shadow-md">Kirim Pesan</button>
            </form>
        </div>
    </div>
</x-app-layout>