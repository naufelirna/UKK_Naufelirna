<div>
    <form wire:submit.prevent="update" class="space-y-4">
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

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                    Update
                </button>
            </div>