@extends('admin.index_content')

@section('content')
<div class="content">
    <div class="content-wrapper">
        <!-- Alert untuk notifikasi success -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h3 class="mb-3">Laporan Kunjungan</h3>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form id="filterForm" method="GET" action="{{ route('admin.log_pengunjung') }}">
                    <div class="row">
                        <!-- Filter Tahun -->
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select" id="tahun" name="tahun">
                                <option value="">Pilih Tahun</option>
                                @for ($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Filter Bulan -->
                        <div class="col-md-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-select" id="bulan" name="bulan">
                                <option value="">Pilih Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Filter Hari -->
                        <div class="col-md-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-select" id="hari" name="hari">
                                <option value="">Pilih Hari</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ request('hari') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Tombol Filter dan Reset -->
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <a href="{{ route('admin.log_pengunjung') }}" class="btn btn-secondary">
                                <i class="fas fa-sync"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tombol Export -->
        <div class="mb-3">
            <a href="{{ route('admin.export_pdf') }}?tahun={{ request('tahun') }}&bulan={{ request('bulan') }}&hari={{ request('hari') }}" 
               class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>

        <!-- Tabel Log Kunjungan -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Instansi</th>
                        <th scope="col">Nama PIC</th>
                        <th scope="col">Nomor</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Karyawan Dituju</th>
                        <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengunjung as $p)
                        <tr class="text-center">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="text-wrap">{{ $p->nama_instansi }}</td>
                            <td>{{ $p->nama_pengunjung }}</td>
                            <td>{{ $p->nomor_pengunjung }}</td>
                            <td>{{ $p->tujuan_pertemuan }}</td>
                            <td>{{ $p->karyawan_dituju }}</td>
                            <td>{{ $p->tanggal_pertemuan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            {{ $pengunjung->links() }}
        </div>
    </div>
</div>

<!-- Tambahkan Font Awesome untuk icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection