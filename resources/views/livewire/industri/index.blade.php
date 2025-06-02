<div class="px-8">
    <!-- Header Aksi: Tambah & Cari -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mt-6 mb-6">
        <!-- Tombol Tambah -->
        <a href="{{ route('industriCreate') }}"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Tambahkan Data Industri
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
                    placeholder="Cari data Industri" />
            </div>
        </form>
    </div>

    <!-- Flash Message -->
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Data Industri -->
     <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-black-500">
           <thead style="background-color: #1E3A8A; color: white;" class="text-xs uppercase">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Bidang Usaha</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Kontak</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Website</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($industris as $industri)
                    <tr class="background-color: white; border-bottom: 1px solid #BFDBFE;"
                        onmouseover="this.style.backgroundColor='#A78BFA';"
                        onmouseout="this.style.backgroundColor='white';">
                        <td class="px-6 py-4">{{ $industri->nama }}</td>
                        <td class="px-6 py-4">{{ $industri->bidang_usaha }}</td>
                        <td class="px-6 py-4">{{ $industri->alamat }}</td>
                        <td class="px-6 py-4">{{ $industri->kontak }}</td>
                        <td class="px-6 py-4">{{ $industri->email }}</td>
                        <td class="px-6 py-4">{{ $industri->web }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 1rem; color: gray;">
                            Tidak ada data industri ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
