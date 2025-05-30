<div class="px-8 bg-gray-900 min-h-screen text-gray-200">
     <!-- Header: Tombol Tambah + Form Search -->
    <div class="flex justify-between items-center mb-6 pt-6">
        <!-- Tombol Tambah Data -->
        <a href="{{ route('pklCreate') }}" type="button"
            class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-800 font-medium rounded-lg text-sm px-4 py-2 transition-colors duration-200">
            Tambahkan Data PKL
        </a>

        <!-- Form Search -->
        <form class="flex items-center">
            <label for="default-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="search"
                    wire:model.live="search"
                    class="block w-64 p-2 ps-10 text-sm border rounded-lg bg-gray-800 border-gray-700 placeholder-gray-400 focus:ring-purple-600 focus:border-purple-600"
                    placeholder="Cari siswa PKL" />
            </div>
        </form>
    </div>

   @if (session()->has('success'))
        <div class="bg-green-900 text-green-200 px-4 py-2 rounded-md mb-4 border border-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-900 text-red-200 px-4 py-2 rounded-md mb-4 border border-red-700">
        {{ session('error') }}
        </div>
    @endif

    <!-- Table PKL -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-400">
            <thead class="text-xs uppercase bg-gray-800 text-gray-300">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">NIS</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Guru Pembimbing</th>
                    <th class="px-6 py-3">Industri</th>
                    <th class="px-6 py-3">Bidang Usaha</th>
                    <th class="px-6 py-3">Mulai</th>
                    <th class="px-6 py-3">Selesai</th>
                    <th class="px-6 py-3">Durasi</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pkls as $key => $pkl)
                    <tr class="border-b bg-gray-900 border-gray-700 hover:bg-gray-800 transition-colors duration-150">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $pkl->siswa->nis }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pkl->siswa->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pkl->guru->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pkl->industri->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pkl->industri->bidang_usaha }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($pkl->mulai)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($pkl->selesai)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($pkl->mulai)->diffInDays(\Carbon\Carbon::parse($pkl->selesai)) }}
                            hari
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-x-2 justify-center">
                                <a href="{{ route('pklView', ['id' => $pkl->id ]) }}" type="button"
                                    class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-800 font-medium rounded-lg text-sm px-4 py-2 transition-colors duration-200">
                                    View
                                </a>
                                @php 
                                    $user = Auth::user();
                                @endphp
                                @if ($user && $user->email === $pkl->siswa->email)
                                <a href="{{ route('pklEdit', ['id' => $pkl->id ]) }}" type="button"
                                    class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-800 font-medium rounded-lg text-sm px-4 py-2 transition-colors duration-200">
                                    Edit
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-400">Tidak ada siswa terdaftar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>