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
            <div class="card">
                    <div class="card-body">
                        <form id="filterForm" method="GET" action="{{ route('admin.dashboard') }}">
                            <div class="row">
                                <!-- Filter Tahun -->
                                <div class="col-md-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <select class="form-select" id="tahun" name="tahun">
                                        <option value="">Pilih Tahun</option>
                                        @for ($i = date('Y'); $i >= 2020; $i--)
                                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
        
                                <!-- Filter Bulan -->
                                <div class="col-md-3">
                                    <label for="bulan" class="form-label">Bulan</label>
                                    <select class="form-select" id="bulan" name="bulan">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                        @endfor
                                    </select>
                                </div>
        
                                <!-- Filter Hari -->
                                <div class="col-md-3">
                                    <label for="hari" class="form-label">Hari</label>
                                    <select class="form-select" id="hari" name="hari">
                                        <option value="">Pilih Hari</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}" {{ request('hari') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
        
                                <!-- Tombol Filter dan Reset -->
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                        <i class="fas fa-sync"></i> Reset
                                    </a>
                                </div>
                            
                            </div>
                        </form>
                        <div class="card-body">
                            <canvas id="chartKunjungan" width="800" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © DesGuestBookAdmin</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="#" target="_blank">Guestbook</a> from DESNET</span>
        </div>
    </footer>

    <!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script untuk menampilkan chart -->
