<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nis', 'gender', 'alamat', 'kontak', 'email', 'status_pkl', 'foto'
    ];

    public function pkl()
    {
        return $this->hasOne(Pkl::class);
    }
}