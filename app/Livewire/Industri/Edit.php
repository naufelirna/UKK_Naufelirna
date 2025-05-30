<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Livewire\Industri;

class Edit extends Component
{
    public $industriId;
    public $nama, $bidang_usaha, $alamat, $kontak, $email, $website;

    public function mount($id){
        $this->industriId = $id;
        $industri = Industri::findOrFail($id);

        //isi form awal sebelum diedit
        $this->nama = $industri->nama;
        $this->bidang_usaha = $industri->bidang_usaha;
        $this->alamat = $industri->alamat;
        $this->kontak = $industri->kontak;
        $this->email = $industri->email;
        $this->website = $industri->website;
    }

    public function update(){
        $industri = Industri::findOrFail($this->industriId);

        $this->validate([ //validasi
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:400',
            'kontak' => 'required|numeric',
            'email' => 'required|email|unique:industris,email,'. $industri->id,
            'website' => 'required|url|max:255',
        ]);

        $industri->update([
            'nama' => $this->nama,
            'bidang_usaha' => $this->bidang_usaha,
            'alamat' => $this->alamat,
            'kontak' => $this->kontak,
            'email' => $this->email,
            'website' => $this->website,
        ]);

        session()->flash('success', 'Industri berhasil diperbarui');
            return redirect('/dataIndustri');
    }
    
    public function render()
    {
        return view('livewire.industri.edit');
    }
}
