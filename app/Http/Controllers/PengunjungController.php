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

        return view('index',compact('Karyawan'));
    }

    // Menangani submit form
    public function submitForm(Request $request)
    {
        // Validasi input
        $request->validate([
            'instansi' => 'required|string',
            'nama' => 'required|string',
            'nohp' => 'required|string',
            'tujuan' => 'required|string',
            'karyawan' => 'required|string',
            'foto_identitas' => 'required|string', // Gambar dalam format base64
        ]);

        // Simpan gambar ke storage
        $image = $request->foto_identitas;
        $image = str_replace('data:image/jpeg;base64,', '', $image); // Hapus prefix base64
        $image = str_replace(' ', '+', $image); // Ganti spasi dengan +
        $imageName = time() . '.jpeg'; // Nama file
        Storage::disk('public')->put($imageName, base64_decode($image));

        // Simpan data ke database (contoh sederhana)
        // Anda bisa menyesuaikan dengan model dan migrasi yang sudah dibuat
        Pengunjung::create ([
            'instansi' => $request->instansi,
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'tujuan' => $request->tujuan,
            'karyawan' => $request->karyawan,
            'foto_identitas' => $imageName, // Simpan nama file gambar
        ]);

        // Contoh: Simpan ke session (untuk sementara)
        //session()->flash('data', $data);

        return response()->json(['success' => true]);
    }
}
