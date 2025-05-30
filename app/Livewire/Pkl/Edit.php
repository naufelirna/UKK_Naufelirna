<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $pklId;
    public $siswa_id, $guru_id, $industri_id;
    public $tanggal_mulai, $tanggal_selesai;

    public function mount($id){
        $this->pklId = $id;
        $pkl = Pkl::findOrFail($id);

        //Auth::user()->email = mengambil email dari user login
        //$pkl->siswa->email = mengambil email dari siswa yg terhubung dengan data pkl
        //!== tidak sama
        //Kalau email user yang login tidak sama dengan email siswa pemilik data PKL ini, maka abort
        if (Auth::user()->email !==$pkl->siswa->email){
            abort(403, 'Anda tidak memiliki izin untuk mengedit data ini'); 
        }

        //isi form awal sebelum diedit
        $this->siswa_id = $pkl->siswa_id;
        $this->guru_id = $pkl->guru_id;
        $this->industri_id = $pkl->industri_id;
        $this->tanggal_mulai = $pkl->mulai;
        $this->tanggal_selesai = $pkl->selesai;
    }

    public function update(){
        $this->validate([ //validasi
            'siswa_id' => 'required|exists:siswas,id',
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:mulai',
        ]);

        $siswaTerdaftar = Pkl::where('siswa_id', $this->siswa_id)
        ->where('id', '!=', $this->pklId) //jangan hitung data yg sedang diedit
        ->exists();
    
        if ($siswaTerdaftar){
            session()->flash('error', 'Siswa sudah terdaftar di PKL');
            return;
        }

        $pkl = Pkl::findOrFail($this->pklId);

        $pkl->update([
            'siswa_id' => $this->siswa_id,
            'guru_id' => $this->guru_id,
            'industri_id' => $this->industri_id,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
        ]);

        session()->flash('success', 'Data berhasil diperbarui');
        return redirect('/dataPkl');
    }
    
    public function render()
    {
        return view('livewire.pkl.edit', [
            'siswas' => Siswa::all(),
            'gurus' => Guru::all(),
            'industris' => Industri::all(),
        ]);
    }
}
