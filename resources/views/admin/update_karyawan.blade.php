@extends('admin.index_content')

@section('content')
<div class="content">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Karyawan</h4>
                <form action="{{ route('admin.fupdate_karyawan', ['id' => $karyawan->id_karyawan]) }}" method="POST" class="form-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama_karyawan" value="{{ $karyawan->nama_karyawan }}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email_karyawan" value="{{ $karyawan->email_karyawan }}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password_karyawan" placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Update
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