<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri; //import model industri biar bisa dipake buat create data

class Create extends Component
{
    //properti buat nammpung input dari form (wire:model)
    public $nama, $bidang_usaha, $alamat, $kontak, $email, $web;

    public function create(){
        //validasi input sesuai aturan
        $this->validate([ 
            'nama' => 'required',
            'bidang_usaha' => 'required',
            'web' => 'nullable|url',
            'alamat' => 'required',
            'kontak' => 'required|numeric',
            'email' => 'required|email',
        ]);

        Industri::create([
                'nama' => $this->nama,
                'bidang_usaha' => $this->bidang_usaha,
                'web' => $this->web,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
            ]);
            
            //flash message sukses
            session()->flash('success', 'Industri berhasil ditambahkan');
            //redirect ke halaman data industri setelah sukses nambahin data
            return redirect('/dataIndustri');
    }
    
    public function render()
    {
        return view('livewire.industri.create');
    }
}
