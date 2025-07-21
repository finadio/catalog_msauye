<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard / Pesan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg text-center font-medium shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-xl p-6 min-h-[300px]">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Daftar Pesan Masuk</h3>
            {{-- Filter & Search Form --}}
            <form method="GET" class="mb-6 flex flex-col sm:flex-row sm:flex-nowrap items-center gap-3">
                <div class="relative w-full sm:flex-1">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari pesan berdasarkan nama, email, subjek, atau isi pesan..."
                        class="h-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500 w-full pr-12"
                    >
                </div>
                <select name="is_read" class="h-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 w-full sm:w-56">
                    <option value="">Semua Status</option>
                    <option value="0" @selected(request('is_read')==='0')>Belum Dibaca</option>
                    <option value="1" @selected(request('is_read')==='1')>Sudah Dibaca</option>
                </select>
                <button type="submit" class="h-10 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition ease-in-out duration-150 font-semibold shadow-sm w-full sm:w-auto">Filter</button>
                @if(request('q') || request('is_read') !== null)
                    <a href="{{ route('admin.contact.index') }}" class="w-full sm:w-auto px-8 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 font-semibold text-lg transition duration-300 ease-in-out shadow-md transform hover:-translate-y-0.5 text-center">Reset Filter</a>
                @endif
            </form>
            {{-- Contact List Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Subjek</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($contacts as $contact)
                            <tr class="hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $contact->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $contact->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $contact->subject }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                    @if($contact->is_read)
                                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Sudah Dibaca</span>
                                    @else
                                        <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Belum Dibaca</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.contact.show', $contact->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            Detail
                                        </a>
                                        @if(!$contact->is_read)
                                        <form method="POST" action="{{ route('admin.contact.markAsRead', $contact->id) }}" onsubmit="return confirm('Tandai pesan ini sebagai sudah dibaca?');">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                                Tandai Terbaca
                                            </button>
                                        </form>
                                        @endif
                                        <button
                                            type="button"
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-contact-deletion-{{ $contact->id }}')"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            {{-- Delete Confirmation Modal --}}
                            <x-modal name="confirm-contact-deletion-{{ $contact->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="POST" action="{{ route('admin.contact.destroy', $contact->id) }}" class="p-6">
                                    @csrf @method('DELETE')
                                    <h2 class="text-lg font-medium text-gray-900">
                                        Apakah Anda yakin ingin menghapus Pesan ini?
                                    </h2>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Pesan ini akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            Batal
                                        </x-secondary-button>
                                        <x-danger-button class="ms-3">
                                            Hapus Pesan
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500 text-lg">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pesan masuk</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Kotak masuk pesan Anda kosong.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6 flex justify-center">
                {{ $contacts->onEachSide(1)->links('vendor.pagination.modern') }}
            </div>
        </div>
    </div>
</x-app-layout>