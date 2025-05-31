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
    public $siswa_id, $guru_id, $industri_id, $tanggal_mulai, $tanggal_selesai; //ini adalah properti yang dipanggil di blade

    //nyimpen nama siswa yg sedang login
    public $nama_siswa;


      protected string $layout = 'layouts.app';

    public function mount(){
        //ambil email user yg login
        //mengambil data dr tabel user
        //laravel secara default pake model app\models\user yg terkait langsung dengan tabel users
        $userEmail = Auth::user()->email; //jgn lupa tambahin import class auth 

        //cari data siswa berdasarkan email tsb
        //Siswa::where('email', $userEmail) = pada model siswa, database siswas, cari email berdasarkan $userEmail yg sedang login
        //nilai akan disimpan di $siswa
        $siswa = Siswa::where('email', $userEmail)->first();

        //kalo data siswa ditemukan,
        if ($siswa){
            $this->siswa_id = $siswa->id;
            $this->nama_siswa = $siswa->nama;
        }
    }


    //fungsi biat nyimpen data pkl baru (dipanggil pas submit form)
    public function create(){
        $this->validate([ //validasi semua input
            //validasi disesuaikan dari wire:model di blade
            'siswa_id' => 'required|exists:siswas,id', //siswa_id = nama input yg divalidasi 
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        //mulai transaksi db biar kalo error,, data ga setengah masuk
        DB::beginTransaction();

        try{
            $siswa = Siswa::findOrFail($this->siswa_id);
            //ngecek uda perna lapor apa belum
            if ($siswa->status_lapor_pkl){
                DB::rollBack();
                //kalo uda lapor, batalkan transaksi dan kemmbalikan data ke kondisi awal
                session()->flash('error', 'Laporan Dibatalkan: Siswa ini sudah memiliki data PKL.');
                //redirect ke halaman daftar data pkl
                return redirect('/dataPkl');
            }

            //nyimpen data ke tabel pkl, butuh model pkl
            Pkl::create([
                'siswa_id' => $this->siswa_id,
                'guru_id' => $this->guru_id,
                'industri_id' => $this->industri_id,
                'tanggal_mulai' => $this->tanggal_mulai,
                'tanggal_selesai' => $this->tanggal_selesai,
            ]);

            //setelah berhasil buat data pkl, update status siswa bahwa uda lapor pkl
            $siswa->update([
                'status_lapor_pkl' => true
            ]);


            //simpan perubahan permanen di db
            DB::commit();

            session()->flash('success', 'Data berhasil ditambahkan');
            return redirect('dataPkl');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data');
            return redirect('/dataPkl');
        }
    }


    //fungsi buat nampilin halaman form (ngirimm data ke blade)
    public function render()
    {

        //ambil semua data pkl (bisa buat list atau referensi)
        $pkls = Pkl::all();
        //$siswas = Siswa::all(); | dropdown
        $industris = Industri::all();
        $gurus = Guru::all();

        //kirim data ke view livewire.pkl.create (blade)
        return view('livewire.pkl.create', [
        'pkls' => $pkls,
        //'siswas' => $siswas,
        'industris' => $industris,
        'gurus' => $gurus,
        ]);
    }
}
