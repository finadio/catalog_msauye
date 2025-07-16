<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pesan Masuk Contact Us</h2>
    </x-slot>
    <div class="py-8 max-w-5xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Subjek</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr>
                            <td class="px-4 py-2">{{ $contact->name }}</td>
                            <td class="px-4 py-2">{{ $contact->email }}</td>
                            <td class="px-4 py-2">{{ $contact->subject }}</td>
                            <td class="px-4 py-2">{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.contact.show', $contact->id) }}" class="text-blue-600 hover:underline mr-2">Detail</a>
                                <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus pesan?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-gray-500 py-8">Belum ada pesan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $contacts->links() }}</div>
    </div>
</x-app-layout> 