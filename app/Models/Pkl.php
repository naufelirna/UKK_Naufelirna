<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pkl extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id', 'industri_id', 'guru_id', 'tanggal_mulai', 'tanggal_selesai', 'status_pkl'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    //booted itu trigger laravel, 
    public static function booted(): void {
        static::creating(function (Pkl $pkl) {
            if (self::where('siswa_id', $pkl->siswa_id)->exists()) {
                throw new \Exception('Siswa ini sudah memiliki PKL.');
            }
        });
        static::created(function (Pkl $pkl) {
            $pkl->siswa->update(['status_pkl' => 1]); //ketika siswa update tabel pkl atau add maka status pkl akan bernilai 1 (true)
        });
        static::deleted(function (Pkl $pkl) {
            $pkl->siswa->update(['status_pkl' => 0]); //ketika pkl dihapus, maka siswa akan otomatis terganti status pkl nya
        });
    }
}
