<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pkl extends Model
{
    use HasFactory;
    
    protected $table = 'pkls';
    
    protected $fillable = [
        'siswa_id',
        'guru_id',
        'industri_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_pkl'
    ];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    
    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }
}