<div class="px-8">
     <!-- Header: Tombol Tambah + Form Search -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mt-6 mb-6">
        <!-- Tombol Tambah Data -->
       <a href="{{ route('pklCreate') }}"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Tambahkan Data PKL
        </a>
        <!-- Form Search -->
        <form class="flex items-center">
            <label for="default-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="search"
                    wire:model.live="search"
                    class="block w-64 p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Cari data PKL" />
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
     <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-black-500">
           <thead style="background-color: #1E3A8A; color: white;" class="text-xs uppercase">
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
                    <tr class="background-color: white; border-bottom: 1px solid #BFDBFE;"
                        onmouseover="this.style.backgroundColor='#A78BFA';"
                        onmouseout="this.style.backgroundColor='white';">
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
                                <a href="{{ route('pklEdit', ['id' => $pkl->id]) }}"
                             class="bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-3 py-1.5 rounded-lg transition">
                             Edit
                            </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 1rem; color: gray;">Tidak ada siswa terdaftar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>