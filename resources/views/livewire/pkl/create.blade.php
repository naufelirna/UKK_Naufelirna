<div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-2xl mt-8">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-blue-700">Tambah Laporan PKL</h2>
    </div>

        <form wire:submit.prevent="create" class="space-y-5">

            <!-- Siswa -->
            <div>
                <label for="siswa_id" class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Siswa
                </label>
                 <select wire:model="siswa_id" disabled id="siswa_id" name="siswa_id"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                       focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
                <option value="">-- Pilih Nama Siswa --</option>
                <option value="{{ $siswa_id }}">{{ $nama_siswa }}</option>
            </select>
            </div>

            <!-- Industri -->
            <div>
            <label for="industri_id" class="block mb-2 text-sm font-medium text-gray-900">
                Nama Industri
            </label>
            <select wire:model="industri_id" id="industri_id" name="industri_id"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                       focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
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
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                       focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
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
             <input type="date" wire:model="tanggal_mulai" id="tanggal_mulai" name="tanggal_mulai"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
            @error('mulai')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

            <!-- Tanggal Selesai -->
            <div>
            <label for="selesai" class="block mb-2 text-sm font-medium text-gray-900">
                Tanggal Selesai
            </label>
            <input type="date" wire:model="tanggal_selesai" id="tanggal_selesai" name="tanggal_selesai"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 p-2.5" required>
            @error('selesai')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

            <!-- Tombol Submit -->
            <div class="text-right">
            <button type="submit"
                style="width: 100%; background: linear-gradient(to right, #3B82F6, #8B5CF6); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; cursor: pointer; transition: background 0.3s;"
                onmouseover="this.style.background='linear-gradient(to right, #2563EB, #7C3AED)'"
                onmouseout="this.style.background='linear-gradient(to right, #3B82F6, #8B5CF6)'">
                Simpan
            </button>
        </div>
        </form>
    </div>
