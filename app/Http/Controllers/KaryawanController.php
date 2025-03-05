<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class KaryawanController extends Controller
{
    public function showAfterLogin()
    {
        return view('karyawan.index');
    }

    public function notifikasi()
    {
        $notifikasis = Notifikasi::where('id_pengunjung', auth()->user()->id)->get();
        return view('karyawan.index', compact('notifikasis'));
    }
}
