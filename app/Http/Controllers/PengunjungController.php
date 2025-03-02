<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PengunjungController extends Controller
{
    // Menampilkan form buku tamu
    public function showForm()
    {
        $karyawan = Karyawan::all();

        return view('index',compact('karyawan'));
    }

    // Menangani submit form
    public function submitForm(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_instansi' => 'required|string',
            'nama' => 'required|string',
            'nohp' => 'required|string',
            'tujuan' => 'required|string',
            'id_karyawan' => 'required',
            'foto_identitas' => 'required|string', // Gambar dalam format base64
        ]);

        // Simpan gambar ke storage
        $image = $request->foto_identitas;
        $image = str_replace('data:image/png;base64,', '', $image); // Hapus prefix base64
        $image = str_replace(' ', '+', $image); // Ganti spasi dengan +
        $imageName = time() . '.png'; // Nama file
        Storage::disk('public')->put($imageName, base64_decode($image));

        // Simpan data ke database (contoh sederhana)
        // Anda bisa menyesuaikan dengan model dan migrasi yang sudah dibuat
        Pengunjung::create ([
            'nama_instansi' => $request->nama_instansi,
            'nama_pengunjung' => $request->nama,
            'nomor_pengunjung' => $request->nohp,
            'tujuan_pertemuan' => $request->tujuan,
            'id_karyawan' => $request->id_karyawan,
            'karyawan_dituju' => $request->id_karyawan,
            'foto_identitas' => $imageName,
            'tanggal_pertemuan' => now(), 
        ]);

        // Contoh: Simpan ke session (untuk sementara)
        //session()->flash('data', $data);

        return redirect()->back();
        // return redirect()->route('karyawan.index');
    }
}
