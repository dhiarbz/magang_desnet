<?php

namespace App\Http\Controllers;


use App\Models\Notifikasi;
use App\Models\Pengunjung;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function showAfterLogin()
    {
        $query = Pengunjung::query();
        $jumlahKunjungan = $query->count();
        return view('karyawan.index');
    }

    public function notifikasi()
    {
        return view('karyawan.index', compact('notifikasis'));
    }

    public function view_kunjungan()
    {
        return view('karyawan.view_kunjungan');
    }
}
