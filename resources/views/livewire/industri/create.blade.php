<div style="max-width: 640px; margin: auto; padding: 1rem; background-color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-radius: 1rem;">
    <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; color: #4F46E5;">Tambah Data Industri</h2>

    <form wire:submit.prevent="create" style="display: flex; flex-direction: column; gap: 1rem;">
        <div>
            <label style="font-size: 0.9rem; font-weight: 500; color:rgb(0, 0, 0);">Nama Industri</label>
            <input type="text" wire:model="nama"
                style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; outline: none;"
                onfocus="this.style.borderColor='#A78BFA'; this.style.boxShadow='0 0 0 2px #E9D5FF';"
                onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none';">
            @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
             <label style="font-size: 0.9rem; font-weight: 500; color:rgb(0, 0, 0);">Bidang Usaha</label>
            <input type="text" wire:model="bidang_usaha"
                style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; outline: none;"
                onfocus="this.style.borderColor='#A78BFA'; this.style.boxShadow='0 0 0 2px #E9D5FF';"
                onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none';">
            @error('bidang_usaha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label style="font-size: 0.9rem; font-weight: 500; color:rgb(0, 0, 0);">Website</label>
            <input type="url" wire:model="website"
                placeholder="https://contoh.com"
                style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; outline: none;"
                onfocus="this.style.borderColor='#A78BFA'; this.style.boxShadow='0 0 0 2px #E9D5FF';"
                onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none';">
            @error('website') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label style="font-size: 0.9rem; font-weight: 500; color:rgb(0, 0, 0);">Alamat</label>
            <textarea wire:model="alamat"
               style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; outline: none; resize: vertical;"
                onfocus="this.style.borderColor='#A78BFA'; this.style.boxShadow='0 0 0 2px #E9D5FF';"
                onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none';"></textarea>
            @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label style="font-size: 0.9rem; font-weight: 500; color:rgb(0, 0, 0);">Kontak</label>
            <input type="text" wire:model="kontak"
                placeholder="081234567890"
                style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; outline: none;"
                onfocus="this.style.borderColor='#A78BFA'; this.style.boxShadow='0 0 0 2px #E9D5FF';"
                onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none';">
            @error('kontak') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label style="font-size: 0.9rem; font-weight: 500; color:rgb(0, 0, 0);">Email</label>
            <input type="email" wire:model="email"
                style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; outline: none;"
                onfocus="this.style.borderColor='#A78BFA'; this.style.boxShadow='0 0 0 2px #E9D5FF';"
                onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none';">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4">
            <button type="submit"
                style="width: 100%; background: linear-gradient(to right, #3B82F6, #8B5CF6); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; cursor: pointer; transition: background 0.3s;"
                onmouseover="this.style.background='linear-gradient(to right, #2563EB, #7C3AED)'"
                onmouseout="this.style.background='linear-gradient(to right, #3B82F6, #8B5CF6)'">
                Simpan Industri
            </button>
        </div>
    </form>
</div>
