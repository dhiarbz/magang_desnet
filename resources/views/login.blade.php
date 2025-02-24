<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1E73BE;
            font-family: "Open Sans", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }
        .container img {
            width: 150px;
            margin-bottom: 20px;
        }
        .container label {
            font-weight: bold;
            color: #0E2B5C;
        }
        .container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container button {
            width: 100%;
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
        .lupa {
            color: #c0c0c0;
            text-decoration: none;
            font-size: 14px;
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }
        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }
            .container img {
                width: 100px;
            }
            .container h3 {
                font-size: 18px;
            }
            .container label {
                font-size: 14px;
            }
            .container input {
                padding: 8px;
            }
            .container button {
                padding: 8px;
                font-size: 14px;
            }
            .lupa {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('assets/images/logo_desnet.png') }}" alt="Logo" class="d-block mx-auto">
        <h3 class="text-center">Login</h3>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{url('login')}}">
            @csrf
            <div class="mb-3">
                <label for="email_karyawan">Email*</label>
                <input type="text" id="email_karyawan" name="email_karyawan" class="form-control" required value="{{ old('email') }}">
                @if ($errors->has('email_karyawan'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="password">Password*</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <a href="#" class="lupa">Lupa Password?</a>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
