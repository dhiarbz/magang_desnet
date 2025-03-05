<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showAfterLogin(Request $request)
{
    $filter = $request->filter ?? 'tahun';
    $tahun = $request->tahun ?? Carbon::now()->year;
    $bulan = $request->bulan ?? Carbon::now()->month;
    $minggu = $request->minggu ?? null;

    $query = Pengunjung::query();

    if ($filter == 'tahun') {
        $query->whereYear('tanggal_pertemuan', $tahun);
    } elseif ($filter == 'bulan') {
        $query->whereYear('tanggal_pertemuan', $tahun)
              ->whereMonth('tanggal_pertemuan', $bulan);
    } elseif ($filter == 'minggu') {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $query->whereBetween('tanggal_pertemuan', [$startOfWeek, $endOfWeek]);
    }

    $jumlahPengunjung = $query->count();
    $jumlahKaryawan = Karyawan::count();    

    // Data untuk chart
    $labels = [];
    $data = [];

    if ($filter == 'tahun') {
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->format('F');
            $data[] = Pengunjung::whereYear('tanggal_pertemuan', $tahun)
                                ->whereMonth('tanggal_pertemuan', $i)->count();
        }
    } elseif ($filter == 'bulan') {
        $weeksInMonth = Carbon::create($tahun, $bulan)->weeksInMonth;
        for ($i = 1; $i <= $weeksInMonth; $i++) {
            $startOfWeek = Carbon::create($tahun, $bulan)->startOfWeek($i);
            $endOfWeek = Carbon::create($tahun, $bulan)->endOfWeek($i);
            $labels[] = 'Minggu ' . $i;
            $data[] = Pengunjung::whereBetween('tanggal_pertemuan', [$startOfWeek, $endOfWeek])->count();
        }
    } elseif ($filter == 'minggu') {
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->startOfWeek()->addDays($i);
            $labels[] = $date->format('l');
            $data[] = Pengunjung::whereDate('tanggal_pertemuan', $date)->count();
        }
    }

    if ($request->ajax()) {
        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    return view('admin.index', compact('jumlahPengunjung', 'jumlahKaryawan', 'labels', 'data', 'filter', 'tahun', 'bulan', 'minggu'));
}
    
    public function logout()
    {
        Auth::guard('web')->logout(); // Logout dari guard web
        return redirect('/');
    }

    public function view_karyawan()
    {
        $karyawan = Karyawan::where('role', '!=', 'admin')->paginate(50);
        return view('admin.view_karyawan',['karyawan' => $karyawan,]);
    }
    public function view_add_karyawan()
    {
        return view('admin.add_karyawan');
    }
    public function fadd_karyawan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email_karyawan',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,karyawan',
        ]);

        Karyawan::create([
            "nama_karyawan" => $request->nama,
            "email_karyawan" => $request->email,
            "password_karyawan" => bcrypt($request->password),
            "role" => $request->role,
        ]);
        return redirect()->route('admin.view_karyawan')->with('success', 'Data Karyawan berhasil ditambahkan');
    }

    public function update_karyawan($id)
    {
        $karyawan = Karyawan::find($id);
        // Jika data tidak ditemukan
        if (!$karyawan) {
            return redirect()->route('admin.view_karyawan')->with('error', 'Data karyawan tidak ditemukan.');
        }

        // Tampilkan view edit dengan data karyawan
        return view('admin.update_karyawan', compact('karyawan'));
    }

    public function fupdate_karyawan(Request $request, $id)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'email_karyawan' => 'required|email|unique:karyawans,email_karyawan,' . $id . ',id_karyawan',
            'password_karyawan' => 'nullable|string|min:8',
        ]);

        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return redirect()->route('admin.view_karyawan')->with('error', 'Data karyawan tidak ditemukan.');
        }

        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->email_karyawan = $request->email_karyawan;
        
        if ($request->filled('password_karyawan')) {
            $karyawan->password_karyawan = bcrypt($request->password_karyawan);
        }      
        $karyawan->save();

        return redirect()->route('admin.view_karyawan')->with('success', 'Data Karyawan berhasil diupdate.');
    }

    public function delete_karyawan($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        return redirect()->route('admin.view_karyawan')->with('success','Data Karyawan berhasil dihapus.');
    }

    public function view_pengunjung()
    {
        $pengunjung = Pengunjung::paginate(50);
        return view('admin.view_pengunjung',['pengunjung' => $pengunjung,]);
    }
    public function view_add_pengunjung()
    {
        $karyawan = Karyawan::all();
        return view('admin.add_pengunjung',compact('karyawan'));
    }

    public function fadd_pengunjung(Request $request)
    {
        $request->validate([
            'instansi' => 'required|string',
            'nama' => 'required|string',
            'nomor' => 'required|string',
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

        Pengunjung::create([
            'nama_instansi' => $request->instansi,
            'nama_pengunjung' => $request->nama,
            'nomor_pengunjung' => $request->nomor,
            'tujuan_pertemuan' => $request->tujuan,
            'id_karyawan' => $request->id_karyawan,
            'karyawan_dituju' => $request->id_karyawan,
            'foto_identitas' => $imageName,
            'tanggal_pertemuan' => now(), 
        ]);
        return redirect()->route('admin.view_pengunjung')->with('success', 'Data Pengunjung berhasil ditambahkan');
    }
    public function update_pengunjung($id)
    {
        $pengunjung = Pengunjung::find($id);
        // Jika data tidak ditemukan
        if (!$pengunjung) {
            return redirect()->route('admin.view_pengunjung')->with('error', 'Data karyawan tidak ditemukan.');
        }
        $karyawan = Karyawan::all();
        // Tampilkan view edit dengan data karyawan
        return view('admin.update_pengunjung', compact('pengunjung','karyawan'));
    }

    public function fupdate_pengunjung(Request $request, $id)
    {
        $request->validate([
            'instansi' => 'required|string',
            'nama' => 'required|string',
            'nomor' => 'required|string',
            'tujuan' => 'required|string',
            'id_karyawan' => 'required',
            'foto_identitas' => 'required|string', // Gambar dalam format base64
        ]);

        $pengunjung = Pengunjung::find($id);
        if (!$pengunjung) {
            return redirect()->route('admin.view_pengunjung')->with('error', 'Data karyawan tidak ditemukan.');
        }
        
        //update pengunjung
        $pengunjung->nama_instansi = $request->instansi;
        $pengunjung->nama_pengunjung = $request->nama;
        $pengunjung->nomor_pengunjung = $request->nomor;
        $pengunjung->tujuan_pertemuan = $request->tujuan;
        $pengunjung->id_karyawan = $request->id_karyawan;

        if ($request->foto_identitas) {
            // Hapus foto lama jika ada
            if ($pengunjung->foto_identitas && Storage::disk('public')->exists($pengunjung->foto_identitas)) {
                Storage::disk('public')->delete($pengunjung->foto_identitas);
            }

            // Simpan foto baru
            $image = $request->foto_identitas;
            $image = str_replace('data:image/png;base64,', '', $image); // Hapus prefix base64
            $image = str_replace(' ', '+', $image); // Ganti spasi dengan +
            $imageName = time() . '.png'; // Nama file
            Storage::disk('public')->put($imageName, base64_decode($image));

            $pengunjung->foto_identitas = $imageName;
        }

              
        $pengunjung->save();

        return redirect()->route('admin.view_pengunjung')->with('success', 'Data Karyawan berhasil diupdate.');
    }

    public function delete_pengunjung($id)
    {
        $pengunjung = Pengunjung::find($id);
        $pengunjung->delete();
        return redirect()->route('admin.view_pengunjung')->with('success','Data Karyawan berhasil dihapus.');
    }

    public function log_pengunjung(Request $request)
    {
        $request->validate([
            'tahun'=> 'nullable | integer |min:2020|max:' . date('Y'),
            'bulan'=> 'nullable | integer |min:1|max:12',
            'hari'=> 'nullable | integer |min:1|max:31',
        ]);

        $query = Pengunjung::query();

        if($request->tahun){
            $query->whereYear('tanggal_pertemuan',$request->tahun);
        }
        if ($request->bulan) {
            $query->whereMonth('tanggal_pertemuan', $request->bulan);
        }
    
        if ($request->hari) {
            $query->whereDay('tanggal_pertemuan', $request->hari);
        }
    
        $pengunjung = $query->paginate(10);
    
        return view('admin.log_pengunjung', compact('pengunjung'));
    }

    public function exportPdf(Request $request)
    {
        $query = Pengunjung::query();
    
        if ($request->tahun) {
            $query->whereYear('tanggal_pertemuan', $request->tahun);
        }
    
        if ($request->bulan) {
            $query->whereMonth('tanggal_pertemuan', $request->bulan);
        }
    
        if ($request->hari) {
            $query->whereDay('tanggal_pertemuan', $request->hari);
        }
    
        $pengunjung = $query->get();
        
        $pdf = Pdf::loadView('admin.export_pdf', compact('pengunjung'));
        return $pdf->download('laporan_kunjungan.pdf');
    }
    
}
