@extends('admin.index_content')

@section('content')
<div class="content">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Pengunjung</h4>
                <form action="{{ route('admin.fupdate_pengunjung', ['id' => $pengunjung->id_pengunjung]) }}" method="POST" class="form-sample">
                    @csrf
                    @method('PUT')
                    <!-- Nama Instansi -->
                    <div class="form-group row mb-3">
                        <label for="instansi" class="col-sm-3 col-form-label">Nama Instansi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="instansi" name="instansi" value="{{ $pengunjung->nama_instansi }}" required>
                        </div>
                    </div>

                    <!-- Nama Pengunjung -->
                    <div class="form-group row mb-3">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Pengunjung</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pengunjung->nama_pengunjung }}" required>
                        </div>
                    </div>

                    <!-- Nomor Pengunjung -->
                    <div class="form-group row mb-3">
                        <label for="nomor" class="col-sm-3 col-form-label">Nomor Pengunjung</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nomor" name="nomor" value="{{ $pengunjung->nomor_pengunjung }}" required>
                        </div>
                    </div>

                    <!-- Tujuan Pertemuan -->
                    <div class="form-group row mb-3">
                        <label for="tujuan" class="col-sm-3 col-form-label">Tujuan Pertemuan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ $pengunjung->tujuan_pertemuan }}" required>
                        </div>
                    </div>

                    <!-- Karyawan Dituju -->
                    <div class="form-group row mb-3">
                        <label for="id_karyawan" class="col-sm-3 col-form-label">Karyawan Dituju</label>
                        <div class="col-sm-9">
                            <select name="id_karyawan" class="form-control" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($karyawan as $k)
                                    <option value="{{ $k->id_karyawan }}" {{ $pengunjung->id_karyawan == $k->id_karyawan ? 'selected' : '' }}>
                                        {{ $k->nama_karyawan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Foto Identitas -->
                    <div class="form-group row mb-3">
                        <label for="foto" class="col-sm-3 col-form-label">Foto Identitas</label>
                        <div class="col-sm-9">
                            <button type="button" class="btn btn-secondary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#cameraModal">
                                <i class="fas fa-camera"></i> Ambil Foto Baru
                            </button>
                            <div class="text-center">
                                <img id="preview" src="{{ asset('storage/' . $pengunjung->foto_identitas) }}" alt="Preview Foto" style="width: 100%; max-width: 300px; border: 1px solid #ccc; border-radius: 5px;">
                            </div>
                            <input type="hidden" id="foto_identitas" name="foto_identitas">
                        </div>
                    </div>

                    <!-- Tombol Submit dan Cancel -->
                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('admin.view_pengunjung') }}" class="btn btn-light">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kamera -->
<div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cameraModalLabel">Ambil Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <video id="video" autoplay style="width: 100%; max-width: 400px; border: 1px solid #ccc; border-radius: 5px;"></video>
                <canvas id="canvas" style="display: none;"></canvas>
                <button type="button" id="snap" class="btn btn-primary mt-3">
                    <i class="fas fa-camera"></i> Ambil Foto
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Kamera -->
<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const snap = document.getElementById('snap');
    const preview = document.getElementById('preview');
    const foto_identitas = document.getElementById('foto_identitas');

    // Akses kamera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            console.error("Error accessing webcam: ", err);
        });

    // Ambil foto
    snap.addEventListener('click', () => {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Konversi ke base64
        const imageData = canvas.toDataURL('image/png');
        foto_identitas.value = imageData;

        // Tampilkan preview foto
        preview.src = imageData;
        preview.style.display = "block";

        // Tutup modal
        let modal = bootstrap.Modal.getInstance(document.getElementById('cameraModal'));
        modal.hide();
    });
</script>
@endsection