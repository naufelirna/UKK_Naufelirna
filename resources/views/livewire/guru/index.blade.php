<div class="px-8">
    <div class="flex justify-end items-center mb-6 mt-6">
<!-- sort -->
        <div>
            <label for="sortAbjad" class="sr-only">Urutkan Abjad</label>
            <select id="sortAbjad" wire:model.live="selected_abjad"
                class="block w-44 p-2 text-sm border border-blue-300 rounded-lg bg-white text-gray-900 focus:ring-purple-500 focus:border-purple-500">
                <option value="">Urutkan nama</option>
                <option value="Abjad : A-Z">Abjad : A-Z</option>
                <option value="Abjad : Z-A">Abjad : Z-A</option>
            </select>
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
        <table class="w-full text-sm text-left rtl:text-right text-black-500">
           <thead style="background-color: #1E3A8A; color: white;" class="text-xs uppercase">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">NIP</th>
                    <th class="px-6 py-3">Gender</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Kontak</th>
                    <th class="px-6 py-3">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gurus as $guru)
                    <tr
                        class="background-color: white; border-bottom: 1px solid #BFDBFE;"
                        onmouseover="this.style.backgroundColor='#A78BFA';"
                        onmouseout="this.style.backgroundColor='white';">
                        <th scope="row"
                            style="padding: 1rem; font-weight: 600; color: #1E3A8A;">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $guru->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $guru->nip }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $guru->gender }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $guru->alamat }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $guru->kontak }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $guru->email }}
                        </td>
                        <!-- <td class="px-6 py-4">
                            <div class="flex gap-x-2">

                            </div>
                        </td> -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 1rem; color: gray;">Tidak ada guru terdaftar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
