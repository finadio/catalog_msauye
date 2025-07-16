<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Kategori</h2>
    </x-slot>
    <div class="py-8 max-w-3xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <div class="mb-4">
            <a href="{{ route('admin.kategori.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah Kategori</a>
        </div>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Nama Kategori</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                        <tr>
                            <td class="px-4 py-2">{{ $cat->name }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.kategori.edit', $cat->id) }}" class="text-yellow-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('admin.kategori.destroy', $cat->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus kategori?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center text-gray-500 py-8">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $categories->links() }}</div>
    </div>
</x-app-layout> 