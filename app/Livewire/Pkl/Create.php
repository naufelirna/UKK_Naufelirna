<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; //ini jgn lupa!!!!!

class Create extends Component
{
    public $siswa_id, $guru_id, $industri_id, $mulai, $selesai; //ini adalah properti yang dipanggil di blade

    //menyimpan nama siswa yg sedang login
    public $nama_siswa;

    public function mount(){
        //mengambil email user yg login
        //mengambil data dari tabel user
        //laravel secara default pakai model app\models\user yg terkait langsung dengan tabel users
        $userEmail = Auth::user()->email; //jgn lupa tambahin import class auth 

        //cari data siswa berdasarkan email
        //Siswa::where('email', $userEmail) = pada model siswa, database siswas, cari email berdasarkan $userEmail yg sdg login
        //nilai akan disimpan di $siswa
        $siswa = Siswa::where('email', $userEmail)->first();

        if ($siswa){
            //simpan id siswa ($siswa->id) ke $siswa_id (dipakai untuk input form tersembunyi)
            $this->siswa_id = $siswa->id;
            $this->nama_siswa = $siswa->nama;
        }
    }

    public function create(){
        $this->validate([ //validasi semua input
            //validasi disesuaikan dari wire:model di blade
            'siswa_id' => 'required|exists:siswas,id', //siswa_id = nama input yg divalidasi 
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        //transaksi, supaya query berikutnya dijalankan bersama, dan bisa rollback saat ada error
        DB::beginTransaction();

        try{
            //ambil data berdasarlan siswa_id, if no then error 404
            $siswa = Siswa::findOrFail($this->siswa_id);
            //cek apa siswa sebelumnya pernah lapor
            if ($siswa->status_lapor_pkl){
                DB::rollBack();
                //jika sudah lapor, data akan di rollback dengan error message dibawah
                //rollback akan mengembalikan database ke kondisi sebelum transaksi dimulai
                session()->flash('error', 'Laporan Dibatalkan: Siswa ini sudah memiliki data PKL.');
                return redirect('/dataPkl');
            }

            //menyimpan data ke tabel pkl, butuh model PKl
            Pkl::create([
                'siswa_id' => $this->siswa_id,
                'guru_id' => $this->guru_id,
                'industri_id' => $this->industri_id,
                'tanggal_mulai' => $this->tanggal_mulai,
                'tanggal_selesai' => $this->tanggal_selesai,
            ]);

            // Tambahkan setelah create
            $siswa->update([
                'status_lapor_pkl' => true
            ]);

            DB::commit();

            session()->flash('success', 'Data berhasil ditambahkan');
            return redirect('dataPkl');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data');
            return redirect('/dataPkl');
        }
    }

    public function render()
    {
        $pkls = Pkl::all();
        //$siswas = Siswa::all(); | ini kemarin untuk dropdown semua siswa
        //sedangkan kita ingin input user yg sedang login saja
        $industris = Industri::all();
        $gurus = Guru::all();

        return view('livewire.pkl.create', [
        'pkls' => $pkls,
        //'siswas' => $siswas,
        'industris' => $industris,
        'gurus' => $gurus,
        ]);
    }
}
