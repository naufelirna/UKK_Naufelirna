<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Guru;

class Index extends Component
{
    public $search = ''; //variabel buat nampung kata kuncicc penccarian

    public $selected_abjad = ''; //vvariabel buat nampung filter urutan abjad

    public function render()
    {

         $gurus =$query = Guru::query();
          
         //  Guru::all(); 
        //ini mengambil semua data dari gurus, misal guru ada 100 data maka dia ambil 100 lgsg
        $gurus = Guru::all();
        //Bikin query builder, tapi belum dieksekusi langsung. 
        //Kamu bisa tambahkan kondisi pencarian (search), filter, sorting, dll sebelum hasil akhirnya diambil.

         if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nip', 'like', '%' . $this->search . '%')
                  ->orWhere('alamat', 'like', '%' . $this->search . '%')
                  ->orWhere('kontak', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->selected_abjad)) {
            if ($this->selected_abjad === 'Abjad : A-Z') {
                $query->orderBy('nama', 'asc');
            } else {
                $query->orderBy('nama', 'desc');
            }
}

$gurus = $query->get(); // ini baru benar, eksekusi query builder dan ambil hasilnya

return view('livewire.guru.index', [
    'gurus' => $gurus,
]);

}
}