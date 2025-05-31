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

    //fungsi ini dijalankan saat komponen dipanggil, dengan parameter id pkl yg mmmau diedit
    public function mount($id){
        $this->pklId = $id;
        $pkl = Pkl::findOrFail($id); //ambil data pkl berdasarkan id atau error kalo gaada

        //ngecek user yg login adalah pemilik data pkl ini (berdasarkan email siswa)
        if (Auth::user()->email !==$pkl->siswa->email){
            abort(403, 'Anda tidak memiliki izin untuk mengedit data ini'); //kalo bukan, tolak akses
        }

        //isi form dengan data lama sebelum diedit
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

        //ngecek apakah siswa uda perna daftar pkl lain (selain data yg sedang diedit)
        $siswaTerdaftar = Pkl::where('siswa_id', $this->siswa_id)
        ->where('id', '!=', $this->pklId) //mengeccualikan data ini sendiri
        ->exists();
    
        if ($siswaTerdaftar){
            //kalo siswa uda punya data pkl lain, berwrti
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
