<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasis';

    protected $primaryKey = 'id_log';

    protected $fillable = [
        'id_pengunjung',
        'id_karyawan',
        'judul_notif',
        'isi_notif',
        'status',
        'tgl_kirim_notif',
    ];

    // Jika Anda ingin mendefinisikan relasi, Anda bisa menambahkannya di sini
    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'id_pengunjung', 'id_pengunjung');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
}