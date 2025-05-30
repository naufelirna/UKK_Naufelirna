<div class="max-w-xl mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Laporan PKL</h2>

        <form wire:submit.prevent="create" class="space-y-4">

            <!-- Siswa -->
            <div>
                <label for="siswa_id" class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Siswa
                </label>
                <select wire:model="siswa_id" disabled id="siswa_id" name="siswa_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          
                          "
                    required>
                    <option value="">-- Pilih Nama Siswa --</option>
                        <option value="{{ $siswa_id }}">{{ $nama_siswa }}</option>
                        <!-- kemarin diisi $siswa->nama, tapi sekarang diganti properties di Create.php -->
                        <!-- terus $siswa->id diganti $siswa_id karena di logikanya ndak ada $siswa, adanya cm properti $siswa_id -->
                </select>
            </div>

            <!-- Industri -->
            <div>
                <label for="industri_id" class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Industri
                </label>
                <select wire:model="industri_id" id="industri_id" name="industri_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          
                          "
                    required>
                    <option value="">-- Pilih Industri --</option>
                    @foreach ($industris as $industri)
                        <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                    @endforeach
                </select>
                @error('industri_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Guru -->
            <div>
                <label for="guru_id" class="block mb-2 text-sm font-medium text-gray-900">
                    Guru Pembimbing
                </label>
                <select wire:model="guru_id" id="guru_id" name="guru_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          
                          "
                    required>
                    <option value="">-- Pilih Guru Pembimbing --</option>
                    @foreach ($gurus as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
                @error('guru_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label for="mulai" class="block mb-2 text-sm font-medium text-gray-900">
                    Tanggal Mulai
                </label>
                <input type="date" wire:model="mulai" id="mulai" name="mulai"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                           
                          "
                    required>
                @error('mulai')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label for="selesai" class="block mb-2 text-sm font-medium text-gray-900">
                    Tanggal Selesai
                </label>
                <input type="date" wire:model="selesai" id="selesai" name="selesai"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                           
                          "
                    required>
                @error('selesai')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
