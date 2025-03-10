@extends('admin.index_content')

@section('content')
<div class="content">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Karyawan</h4>
                <form action="{{ route('admin.fadd_karyawan') }}" method="POST" class="form-sample">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="role" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="role" name="role"  placeholder="Pilih Role" required>
                                <option value="role">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Submit
                            </button>
                            <a href="{{ route('admin.view_karyawan') }}" class="btn btn-light">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection