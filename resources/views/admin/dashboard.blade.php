    <div class="content">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card p-4">
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">{{ $jumlahKaryawan }}</h3>
                    </div>
                    <h5>Karyawan</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4">
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">{{ $jumlahPengunjung }}</h3>
                    </div>
                    <h5>Kunjungan</h5>
                </div>
            </div>
        </div>
        
        <h4 class="mt-4">Chart Kunjungan</h4>
        <div class="chart-container mt-2">
            <button class="btn btn-sm btn-outline-primary float-end">⚙ Filter</button>
            <canvas id="chartKunjungan"></canvas>
        </div>
    </div>
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © DesGuestBookAdmin</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="#" target="_blank">Guestbook</a> from DESNET</span>
        </div>
    </footer>
    