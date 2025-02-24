<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buku Tamu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #1E73BE;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .container img {
            width: 100%;
            max-width: 300px;
            margin: 0 auto 2rem auto;
            display: block;
        }

        .container h2 {
            text-align: center;
            color: #0E2B5C;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: bold;
            color: #0E2B5C;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group video, .form-group canvas {
            display: block;
            margin: 10px auto;
            width: 100%;
            max-width: 300px;
        }

        .form-group button {
            display: block;
            margin: 10px auto;
        }

        .btn-primary {
            width: 100%;
            max-width: 150px;
            padding: 10px;
            background-color: #1E73BE;
            border: none;
            border-radius: 20px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #165a9e;
        }

        .btn-secondary {
            width: 100%;
            max-width: 150px;
            padding: 10px;
            background-color: #6c757d;
            border: none;
            border-radius: 20px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .login-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #1E73BE;
            color: #fff;
            text-decoration: none;
            border-radius: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #165a9e;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .container img {
                max-width: 150px;
            }

            .form-group video, .form-group canvas {
                max-width: 200px;
            }

            .login-button {
                top: 10px;
                right: 10px;
                padding: 6px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <a href="/login" class="login-button">Login</a>
    <div class="container">
        <div class="logo d-flex justify-content-center align-items-center">
            <img src="{{ asset('assets/images/logo_desnet.png') }}" alt="Logo">
        </div>
        <form method="POST" action="{{ route('submit') }}">
            @csrf
            <div class="form-group">
                <label>Asal Instansi</label>
                <input type="text" name="instansi" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" name="nohp" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tujuan</label>
                <input type="text" name="tujuan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Karyawan Tujuan</label>
                <input type="text" name="karyawan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Foto Identitas</label>
                <button type="button" class="btn btn-secondary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#cameraModal">Ambil Foto</button>
                <div class="text-start">
                    <img id="preview" src="" alt="Preview Foto" style="display: none; width: 100%; max-width: 300px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <input type="hidden" id="foto_identitas" name="foto_identitas">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cameraModalLabel">Ambil Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body text-center">
                    <video id="video" autoplay style="width: 100%; max-width: 300px; border: 1px solid #ccc; border-radius:5px;"></video>
                    <canvas id="canvas" style="display: none;"></canvas>
                    <button type="button" id="snap" class="btn btn-primary mt-2">Capture</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const snap = document.getElementById('snap');
        const preview = document.getElementById('preview');
        const foto_identitas = document.getElementById('foto_identitas');

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error("Error accessing webcam: ", err);
            });

        snap.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = canvas.toDataURL('image/png');
            foto_identitas.value = imageData;

            //menampilkan gambar
            preview.src = imageData;
            preview.style.display = "block";

            //tututp modal
            let modal = bootstrap.Modal.getInstance(document.getElementById('cameraModal'));
            modal.hide();
        });
    </script>
</body>
</html>