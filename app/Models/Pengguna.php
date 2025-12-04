<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'nip',
        'kompetensi',
        'divisi',
        'email',
        'no_hp',
    ];

    public function sertifikat()
{
    return $this->hasMany(Sertifikat::class, 'id_pengguna');
}

public function notifikasi()
{
    return $this->hasManyThrough(
        Notifikasi::class,
        Sertifikat::class,
        'id_pengguna',     // Foreign key on Sertifikat
        'id_sertifikat',   // Foreign key on Notifikasi
        'id_pengguna',     // Local key on Pengguna
        'id_sertifikat'    // Local key on Sertifikat
    );
}

}
