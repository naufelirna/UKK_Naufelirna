<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Guru;

class Index extends Component
{
    public $search = '';

    public $selected_abjad = [];

    public function render()
    {
         //$gurus = Guru::all(); 
        //ini mengambil semua data dari gurus, misal guru ada 100 data maka dia ambil 100 lgsg
        $gurus = Guru::query();
        //Bikin query builder, tapi belum dieksekusi langsung. 
        //Kamu bisa tambahkan kondisi pencarian (search), filter, sorting, dll sebelum hasil akhirnya diambil.

        if (!empty($this->search)){ //cek kalau $this not empty, jadi kalau kolom kosong dia ga filter apa2
            $gurus->where(function($query){ //nge-group semua filter pencarian.
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('nip', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%')
                    ->orWhere('kontak', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selected_abjad){
            if ($this->selected_abjad === 'Abjad : A-Z'){
                $gurus->orderBy('nama', 'asc'); //ascending, kecil ke besar A-Z 1-100
            } elseif ($this->selected_abjad){
                $gurus->orderBy('nama', 'desc'); //descending, kebalikan
            }
        }

        return view('livewire.guru.index', [
            'gurus' => $gurus,
        ]);
    }
}
