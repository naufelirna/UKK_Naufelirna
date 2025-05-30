<div class="max-w-xl mx-auto p-4 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Tambah Data Industri</h2>

    <form wire:submit.prevent="create" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Industri</label>
            <input type="text" wire:model="nama"
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Bidang Usaha</label>
            <input type="text" wire:model="bidang_usaha"
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('bidang_usaha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Website</label>
            <input type="url" wire:model="website"
                placeholder="https://contoh.com"
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('website') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea wire:model="alamat"
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                rows="3"></textarea>
            @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kontak</label>
            <input type="text" wire:model="kontak"
                placeholder="081234567890"
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('kontak') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model="email"
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                Simpan Industri
            </button>
        </div>
    </form>
</div>
