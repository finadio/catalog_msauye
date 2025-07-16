<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pesan</h2>
    </x-slot>
    <div class="py-8 max-w-xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-2"><span class="font-semibold">Nama:</span> {{ $contact->name }}</div>
            <div class="mb-2"><span class="font-semibold">Email:</span> {{ $contact->email }}</div>
            <div class="mb-2"><span class="font-semibold">Subjek:</span> {{ $contact->subject }}</div>
            <div class="mb-2"><span class="font-semibold">Tanggal:</span> {{ $contact->created_at->format('d-m-Y H:i') }}</div>
            <div class="mb-4"><span class="font-semibold">Pesan:</span><br>{{ $contact->message }}</div>
            <a href="{{ route('admin.contact.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</x-app-layout> 