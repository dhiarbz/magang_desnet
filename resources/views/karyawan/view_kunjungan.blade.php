@extends('karyawan.index_content')

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

        <h3 class="mb-3">Data Kunjungan</h3>

        <!-- Tombol Tambah Data Pengunjung -->
        <a class="btn btn-primary mb-3" style="max-width: 250px;" href="{{ route('karyawan.add_kunjungan') }}">
            <i class="fas fa-plus"></i> Tambah Data Kunjungan
        </a>

        <!-- Tabel Data Pengunjung -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Instansi</th>
                        <th scope="col">Nama PIC</th>
                        <th scope="col">Nomor</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Karyawan Dituju</th>
                        <th scope="col">Foto Identitas</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($pengunjung as $p)
                        <tr class="text-center">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="text-wrap">{{ $p->nama_instansi }}</td>
                            <td>{{ $p->nama_pengunjung }}</td>
                            <td>{{ $p->nomor_pengunjung }}</td>
                            <td>{{ $p->tujuan_pertemuan }}</td>
                            <td>{{ $p->karyawan_dituju }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $p->foto_identitas) }}" 
                                     alt="Foto Identitas" 
                                     class="rounded img-thumbnail" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td>{{ $p->tanggal_pertemuan }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.update_pengunjung', ['id' => $p->id_pengunjung]) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                               <!-- Tombol Delete -->
                               <form action="{{ route('admin.delete_pengunjung', ['id' => $p->id_pengunjung]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            {{-- {{ $pengunjung->links() }} --}}
        </div>
    </div>
</div>

<!-- Script untuk konfirmasi hapus -->
<script>
    function confirmation(event) {
        event.preventDefault(); // Mencegah aksi default
        const url = event.target.getAttribute('data-url'); // Ambil URL dari atribut data-url

        // Tampilkan dialog konfirmasi
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = url; // Redirect ke URL hapus jika dikonfirmasi
        }
    }
</script>

<!-- Tambahkan Font Awesome untuk icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection