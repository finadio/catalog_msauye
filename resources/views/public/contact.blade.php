<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">Hubungi Kami</h1>
    </x-slot>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow p-8">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('contact') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 font-semibold">Nama</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded focus:outline-none" required value="{{ old('name') }}">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded focus:outline-none" required value="{{ old('email') }}">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Subjek</label>
                    <input type="text" name="subject" class="w-full px-4 py-2 border rounded focus:outline-none" required value="{{ old('subject') }}">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Pesan</label>
                    <textarea name="message" rows="5" class="w-full px-4 py-2 border rounded focus:outline-none" required>{{ old('message') }}</textarea>
                </div>
                <button class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Kirim Pesan</button>
            </form>
        </div>
    </div>
</x-app-layout> 