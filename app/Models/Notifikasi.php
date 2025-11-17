<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';
    public $timestamps = false;

    protected $fillable = [
        'id_sertifikat',
        'judul',
        'isi_pesan',
        'status_kirim',
        'tanggal_kirim',
    ];
    
    public function sertifikat()
{
    return $this->belongsTo(Sertifikat::class, 'id_sertifikat');
}

}
