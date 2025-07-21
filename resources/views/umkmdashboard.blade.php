<x-app-layout>
    <h2>Dashboard UMKM</h2>
    <a href="{{ route('umkm.produk.create') }}">Tambah Produk</a>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->status->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('umkm.produk.edit', $p->id) }}">Edit</a>
                        <form action="{{ route('umkm.produk.destroy', $p->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
