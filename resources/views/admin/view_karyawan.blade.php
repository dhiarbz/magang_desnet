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

        <h3 class="mb-3">Data Karyawan</h3>

        <!-- Tombol Tambah Data Karyawan -->
        <a class="btn btn-primary mb-3" style="max-width: 250px;" href="{{ route('admin.add_karyawan') }}">
            <i class="fas fa-plus"></i> Tambah Data Karyawan
        </a>

        <!-- Tabel Data Karyawan -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">ROLE</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawan as $k)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="text-wrap">{{ $k->nama_karyawan }}</td>
                            <td>{{ $k->email_karyawan }}</td>
                            <td>{{ $k->role }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.update_karyawan', ['id' => $k->id_karyawan]) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Tombol Delete -->
                                <form action="{{ route('admin.delete_karyawan', ['id' => $k->id_karyawan]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            {{ $karyawan->links() }}
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