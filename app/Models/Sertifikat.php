<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikat'; // 👈 tambahkan ini

    protected $primaryKey = 'id_sertifikat'; // kalau primary key bukan 'id'

    protected $fillable = [
        'id_pengguna',
        'nomor_sertifikat',
        'sertifikasi',
        'tgl_terbit',
        'tgl_kadaluarsa',
        'status',
        'foto'
    ];
    
    public function pengguna()
{
    return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
}


    public function notifikasi()
{
    return $this->hasMany(Notifikasi::class, 'id_sertifikat');
}

}
