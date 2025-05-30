<div class="px-8">
    <div class="flex justify-end items-center mb-6 mt-6">
<!-- sort -->
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Dropdown Sort Abjad -->
            <div class="relative">
                <label for="sortAbjad" class="sr-only">Urutkan Abjad</label>
                <select id="sortAbjad" wire:model.live="selected_abjad"
                    class="appearance-none block w-48 pl-3 pr-8 py-2 text-sm border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sortir Nama</option>
                    <option value="Abjad : A-Z">Abjad : A-Z</option>
                    <option value="Abjad : Z-A">Abjad : Z-A</option>
                </select>
                <!-- Icon panah bawah -->
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>


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
                    placeholder="Cari data Guru" />
            </div>
        </form>
    </div>

   {{-- @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded-md mb-4">
        {{ session('error') }}
        </div>
    @endif --}}

    <!-- Table PKL -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">NIS</th>
                    <th class="px-6 py-3">Gender</th>
                    <th class="px-6 py-3">Kontak</th>
                    <th class="px-6 py-3">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($siswas as $key => $siswa)
                    <tr
                        class="bg-white border-b border-gray-200 hover:bg-gray-50">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $siswa->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $siswa->nis }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $siswa->gender }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $siswa->kontak }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $siswa->email }}
                        </td>
                        <!-- <td class="px-6 py-4">
                            <div class="flex gap-x-2">

                            </div>
                        </td> -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada siswa terdaftar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
