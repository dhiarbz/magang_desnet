<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $table = 'pengunjungs';
    protected $primaryKey = 'id_pengunjung';
    protected $fillable = [
        'id_karyawan',
        'nama_instansi',
        'tanggal_pertemuan',
        'tanggal_selesai',
        'status',
        'nama_pengunjung',
        'nomor_pengunjung',
        'karyawan_dituju',
        'tujuan_pertemuan',
        'foto_identitas',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
}
