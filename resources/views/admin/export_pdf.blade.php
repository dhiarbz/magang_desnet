<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kunjungan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Kunjungan</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Instansi</th>
                <th>Nama PIC</th>
                <th>Nomor</th>
                <th>Tujuan</th>
                <th>Karyawan Dituju</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengunjung as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->nama_instansi }}</td>
                    <td>{{ $p->nama_pengunjung }}</td>
                    <td>{{ $p->nomor_pengunjung }}</td>
                    <td>{{ $p->tujuan_pertemuan }}</td>
                    <td>{{ $p->karyawan_dituju }}</td>
                    <td>{{ $p->tanggal_pertemuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>