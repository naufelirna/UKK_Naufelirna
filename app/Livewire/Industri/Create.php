<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Livewire\Industri;

class Create extends Component
{
    public $nama, $bidang_usaha, $alamat, $kontak, $email, $website;

    public function create(){
        $this->validate([ //validasi semua input
            //validasi disesuaikan dari wire:model di blade
            'nama' => 'required',
            'bidang_usaha' => 'required',
            'website' => 'required|url',
            'alamat' => 'required',
            'kontak' => 'required|numeric',
            'email' => 'required|email',
        ]);

        Industri::create([
                'nama' => $this->nama,
                'bidang_usaha' => $this->bidang_usaha,
                'website' => $this->website,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
            ]);
            
            session()->flash('success', 'Industri berhasil ditambahkan');
            return redirect('/dataIndustri');
    }
    
    public function render()
    {
        return view('livewire.industri.create');
    }
}
