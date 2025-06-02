<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $search = '';
    public $hasSubmittedPkl = false;
    
    public function mount()
    {
        $userEmail = Auth::user()->email;
        $siswa = Siswa::where('email', $userEmail)->first();
        
        if ($siswa) {
            $existing = Pkl::where('siswa_id', $siswa->id)->first();
            $this->hasSubmittedPkl = $existing ? true : false;
        }
    }
    
    public function render()
    {
        $pklsQuery = Pkl::with(['siswa', 'guru', 'industri']);

        if (!empty($this->search)) {
            $pklsQuery->where(function ($query) {
                $query->whereHas('siswa', function ($q) {
                    $q->where('nis', 'like', '%' . $this->search . '%')
                        ->orWhere('nama', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('guru', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('industri', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                        ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%');
                });
            });
        }

        $pkls = $pklsQuery->get();

        $siswas = Siswa::all();
        $gurus = Guru::all();
        $industris = Industri::all();

        return view('livewire.pkl.index', [
            'pkls' => $pkls,
            'siswas' => $siswas,
            'gurus' => $gurus,
            'industris' => $industris,
            'hasSubmittedPkl' => $this->hasSubmittedPkl
        ]);
    }
}