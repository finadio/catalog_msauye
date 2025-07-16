<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola UMKM</h2>
    </x-slot>
    <div class="py-8 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <form method="GET" class="mb-4 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari UMKM..." class="px-4 py-2 border rounded w-64">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Cari</button>
        </form>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Telepon</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($umkms as $umkm)
                        <tr>
                            <td class="px-4 py-2 font-semibold">{{ $umkm->name }}</td>
                            <td class="px-4 py-2">{{ Str::limit($umkm->description, 40) }}</td>
                            <td class="px-4 py-2">{{ $umkm->address }}</td>
                            <td class="px-4 py-2">{{ $umkm->phone }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.umkm.show', $umkm->id) }}" class="text-blue-600 hover:underline mr-2">Detail</a>
                                <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="text-yellow-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus UMKM?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-gray-500 py-8">Belum ada UMKM.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $umkms->links() }}</div>
    </div>
</x-app-layout> 