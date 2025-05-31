<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Siswa;

class Index extends Component
{
    public $search = '';
    public $selected_abjad = '';  //ubah ke string, bukan array

    public function render()
    {
        $query = Siswa::query(); //mulai query builder

        if (!empty($this->search)) {
            $query->where(function($q){
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nis', 'like', '%' . $this->search . '%')
                  ->orWhere('alamat', 'like', '%' . $this->search . '%')
                  ->orWhere('kontak', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selected_abjad) {
            if ($this->selected_abjad === 'Abjad : A-Z') {
                $query->orderBy('nama', 'asc');
            } else {
                $query->orderBy('nama', 'desc');
            }
        }

        $siswas = $query->get(); //eksekusi query, dapatkan collection

        return view('livewire.siswa.index', compact('siswas'));
    }
}
