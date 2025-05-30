<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri;

class Index extends Component
{
    public $search = '';

    public function render()
    {
        $industris = Industri::query();

        if (!empty($this->search)){ //cek kalau $this not empty, jadi kalau kolom kosong dia ga filter apa2
            $industris->where(function($query){ //nge-group semua filter pencarian.
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%')
                    ->orWhere('kontak', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('website', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.industri.index', [
            'industris' => $industris->get(),
        ]);
    }
}
