<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(135deg, #4c67ff, #00c6ff);
            color: white;
            padding: 20px;
            transition: width 0.3s;
            z-index: 1000;
        }
        .sidebar h4 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar-brand-wrapper {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar-brand-wrapper img {
            max-width: 100%;
            height: auto;
            width: 150px;
        }
        .nav-link {
            color: white;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s;
            display: flex;
            align-items: center;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
        }
        .nav-link span {
            margin-left: 10px;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s;
            padding-top: 80px; /* Padding untuk menghindari tumpang tindih dengan navbar */
        }
        .navbar {
            width: calc(100% - 260px);
            position: fixed;
            top: 0;
            left: 260px;
            background: linear-gradient(135deg, #4c67ff, #00c6ff);
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: left 0.3s, width 0.3s;
            z-index: 1000; /* Pastikan navbar di atas elemen lain */
        }
        .navbar h3 {
            margin: 0;
        }
        .toggle-btn {
            cursor: pointer;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            transition: transform 0.3s;
        }
        .toggle-btn:hover {
            transform: rotate(90deg);
        }
        .collapsed .sidebar {
            width: 80px;
        }
        .collapsed .sidebar h4,
        .collapsed .nav-link span {
            display: none;
        }
        .collapsed .content {
            margin-left: 80px;
        }
        .collapsed .navbar {
            left: 80px;
            width: calc(100% - 80px);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand-wrapper">
            <a class="sidebar-brand brand-logo-mini">
                <img src="{{asset('assets/images/logo_desnet.png')}}" alt="logo" />
            </a>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="{{route('admin.index')}}" class="nav-link active">📊 <span>Dashboard</span></a></li>
            <li class="nav-item"><a href="{{route('admin.view_karyawan')}}" class="nav-link">📄 <span>Data Karyawan</span></a></li>
            <li class="nav-item"><a href="{{route('admin.view_pengunjung')}}" class="nav-link">📂 <span>Data Pengunjung</span></a></li>
            <li class="nav-item"><a href="{{route('admin.log_pengunjung')}}" class="nav-link">📑 <span>Laporan</span></a></li>
        </ul>
        <hr>
        <a href="{{ route('logout') }}" class="nav-link text-light"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            🔓 <span>Logout</span>
        </a>
        <form action="{{route('logout')}}" id="logout_form" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    
    <div class="navbar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <div class="d-flex align-items-center">
            
            <span class="me-2">🔵 {{ Auth::user()->nama_karyawan }}</span>
        </div>
    </div>
    @yield('content')

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('collapsed');
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</body>
</html>