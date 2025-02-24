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
            font-family: "Open Sans", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            padding: 5rem;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .container img {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
            display: block;
        }

        .container label {
            font-weight: bold;
            color: #0E2B5C;
        }

        .container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container input[type="file"]{
            height: 20vh;
        }

        .container .tombol {
            text-align: right;
            margin-top: 1rem;
        }

        .container button {
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

        .container button:hover {
            background-color: #165a9e;
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

        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .container img {
                max-width: 200px;
            }

            .container button {
                max-width: 100%;
            }
            
            .login-button {
                top: 15px;
                right: 15px;
                padding: 8px 16px;
                font-size: 14px;
            }
        }

        @media (min-width: 768px) {
            .container {
                .container {
                padding: 2rem;
                grid-template-columns: 1fr;
            }

            .container img {
                max-width: 200px;
            }

            .container input[type="file"] {
                height: 15vh;
            }

            .login-button {
                top: 10px;
                right: 10px;
                padding: 6px 12px;
                font-size: 12px;
            }
        }
    }   
    </style>
</head>
<body>
    <a href="/login" class="login-button">Login</a>
    <form method="POST" action="{{url('login')}}">
        @csrf
        <div class="container">
            <div class="logo d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/images/logo_desnet.png') }}" alt="Logo">
            </div>
            <div>
                <label for="instansi">Asal Instansi*</label><br>
                <input type="text" id="instansi" name="instansi" required><br>
                <label for="nama">Nama*</label><br>
                <input type="text" id="nama" name="nama" required><br>
                <label for="nohp">Nomor HP*</label><br>
                <input type="text" id="nohp" name="nohp" required><br>
                <label for="tujuan">Tujuan*</label><br>
                <input type="text" id="tujuan" name="tujuan" required><br>
            </div>
            <div>
                <label for="karyawan">Karyawan Tujuan*</label><br>
                <input type="text" id="karyawan" name="karyawan" required><br>
                <label for="identitas">Foto Identitas*</label><br>
                <input type="file" id="identitas" name="identitas" required><br>
                <div class="tombol">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>