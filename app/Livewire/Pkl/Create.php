<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $siswa_id, $guru_id, $industri_id, $tanggal_mulai, $tanggal_selesai;
    public $nama_siswa;
    public $hasSubmittedPkl = false;

    protected string $layout = 'layouts.app';

    public function mount(){
        $userEmail = Auth::user()->email;
        $siswa = Siswa::where('email', $userEmail)->first();

        if ($siswa){
            $this->siswa_id = $siswa->id;
            $this->nama_siswa = $siswa->nama;
            
            $existing = Pkl::where('siswa_id', $this->siswa_id)->first();
            $this->hasSubmittedPkl = $existing ? true : false;
        }
    }

    public function create(){
        if($this->hasSubmittedPkl) {
            session()->flash('error', 'Anda sudah menambah data PKL sebelumnya');
            return redirect('/dataPkl');
        }
        
        $this->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        DB::beginTransaction();

        try{
            $siswa = Siswa::findOrFail($this->siswa_id);

            Pkl::create([
                'siswa_id' => $this->siswa_id,
                'guru_id' => $this->guru_id,
                'industri_id' => $this->industri_id,
                'tanggal_mulai' => $this->tanggal_mulai,
                'tanggal_selesai' => $this->tanggal_selesai,
                'status_pkl' => 'true'
            ]);

            $siswa->update([
                'status_pkl' => 'true'
            ]);

            DB::commit();

            session()->flash('success', 'Data berhasil ditambahkan');
            return redirect('dataPkl');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menambah data PKL: ' . $e->getMessage());
            return redirect('/dataPkl');
        }
    }

    public function render()
    {
        $pkls = Pkl::all();
        $industris = Industri::all();
        $gurus = Guru::all();

        return view('livewire.pkl.create', [
            'pkls' => $pkls,
            'industris' => $industris,
            'gurus' => $gurus,
            'hasSubmittedPkl' => $this->hasSubmittedPkl,
        ]);
    }
}