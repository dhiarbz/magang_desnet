@extends('karyawan.index_content');

@section('content')
<div class="container">
    <h2>Notifikasi</h2>
    <div class="inbox">
        @if($notifikasis->isEmpty())
            <p>Tidak ada notifikasi baru.</p>
        @else
            <ul class="list-group">
                @foreach($notifikasis as $notifikasi)
                    <li class="list-group-item {{ $notifikasi->status == 'pending' ? 'list-group-item-warning' : 'list-group-item-success' }}">
                        <h5>{{ $notifikasi->judul_notif }}</h5>
                        <p>{{ $notifikasi->isi_notif }}</p>
                        <small>{{ $notifikasi->tgl_kirim_notif->format('d M Y H:i') }}</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection