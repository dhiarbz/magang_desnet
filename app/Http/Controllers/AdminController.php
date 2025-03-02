<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function showAfterLogin()
    {
        $jumlahPengunjung = Pengunjung::count();
        $jumlahKaryawan = Karyawan::count();
        return view('admin.index',compact('jumlahPengunjung', 'jumlahKaryawan'));
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
    
    public function view_pengunjung()
    {
        $pengunjung = Pengunjung::paginate(50);
        return view('admin.view_pengunjung',['pengunjung' => $pengunjung,]);
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

    public function dashboard(Request $request)
    {   
        // Default filter: bulan ini
        $filter = $request->filter ?? 'bulan';

        // Query data kunjungan berdasarkan filter
        $query = Pengunjung::query();

        if ($filter == 'minggu') {
            $query->whereBetween('tanggal_pertemuan', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        } elseif ($filter == 'bulan') {
            $query->whereMonth('tanggal_pertemuan', Carbon::now()->month);
        } elseif ($filter == 'tahun') {
            $query->whereYear('tanggal_pertemuan', Carbon::now()->year);
        }

        $jumlahPengunjung = $query->count();
        $jumlahKaryawan = Karyawan::count();
        // Data untuk chart
        $labels = [];
        $data = [];

        if ($filter == 'minggu') {
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::now()->startOfWeek()->addDays($i);
                $labels[] = $date->format('l');
                $data[] = Pengunjung::whereDate('tanggal_pertemuan', $date)->count();
            }
        } elseif ($filter == 'bulan') {
            $daysInMonth = Carbon::now()->daysInMonth;
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $labels[] = $i;
                $data[] = Pengunjung::whereDay('tanggal_pertemuan', $i)->count();
            }
        } elseif ($filter == 'tahun') {
            for ($i = 1; $i <= 12; $i++) {
                $labels[] = Carbon::create()->month($i)->format('F');
                $data[] = Pengunjung::whereMonth('tanggal_pertemuan', $i)->count();
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'labels' => $labels,
                'data' => $data,
            ]);
        }
        dd($labels, $data);
        return view('admin.dashboard', compact('jumlahPengunjung', 'jumlahKaryawan', 'labels', 'data', 'filter'));
    }

}
