<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Management Ringkasan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">📊 LogiTrack Management (Admin)</a>
            <button class="btn btn-sm btn-outline-light" onclick="muatUlangData()">🔄 Segarkan Data (Refresh)</button>
        </div>
    </nav>

    <div class="container my-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">Indikator Kinerja Operasional (KPI)</h2>
                <small class="text-muted">Menampilkan data kalkulasi terbaru yang di-input oleh Dispatcher</small>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body">
                        <h6>Utilisasi Armada</h6>
                        <h3 class="fw-bold" id="kpiUtilisasi">0%</h3>
                        <small class="text-white-50">Dari total armada terdaftar</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-success text-white">
                    <div class="card-body">
                        <h6>Total Trip Selesai</h6>
                        <h3 class="fw-bold" id="kpiTotalTrip">0</h3>
                        <small class="text-white-50">Akumulasi keseluruhan</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-warning text-dark">
                    <div class="card-body">
                        <h6>Ketepatan Waktu</h6>
                        <h3 class="fw-bold">94.2%</h3>
                        <small class="text-dark-50">Estimasi vs Aktual Lapangan</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-danger text-white">
                    <div class="card-body">
                        <h6>Total Biaya Distribusi</h6>
                        <h3 class="fw-bold" id="kpiTotalBiaya">Rp 0</h3>
                        <small class="text-white-50">Akumulasi biaya perjalanan</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold text-secondary">🛣️ Ketersediaan Kapasitas Per Jalur Utama</div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush" id="listJalur">
                            </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold text-secondary">👥 Kontrol Pengguna (User Management)</div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Akses Sistem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Hendra Wijaya</strong></td>
                                    <td><span class="badge bg-dark">Management / Admin</span></td>
                                    <td><span class="text-success">● Seluruh Fitur</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Rian Hidayat</strong></td>
                                    <td><span class="badge bg-secondary">Dispatcher</span></td>
                                    <td><span class="text-primary">● Input & Update Lapangan</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button class="btn btn-outline-secondary" onclick="window.print()">🖨️ Cetak Laporan Evaluasi Bulanan</button>
        </div>

    </div>

    <script>
        function muatUlangData() {
            // Mengambil data terupdate dari localStorage yang diisi oleh Dispatcher
            let armadaData = JSON.parse(localStorage.getItem('armadaData')) || [];
            let tripStats = JSON.parse(localStorage.getItem('tripStats')) || { totalTrip: 0, totalBiaya: 0 };

            // 1. Hitung Statistik Utilisasi (Berapa banyak yang sedang di jalan)
            let totalArmada = armadaData.length;
            let armadaJalan = armadaData.filter(a => a.status === 'Sedang dalam Perjalanan').length;
            let armadaReady = armadaData.filter(a => a.status === 'Siap Beroperasi').length;
            let persentaseUtilisasi = totalArmada > 0 ? ((armadaJalan / totalArmada) * 100).toFixed(1) : 0;

            // Update UI KPI
            document.getElementById('kpiUtilisasi').innerText = persentaseUtilisasi + '%';
            document.getElementById('kpiTotalTrip').innerText = tripStats.totalTrip;
            document.getElementById('kpiTotalBiaya').innerText = 'Rp ' + tripStats.totalBiaya.toLocaleString('id-ID');

            // 2. Render Kapasitas Jalur (Simulasi Dinamis berdasarkan status armada)
            const listJalur = document.getElementById('listJalur');
            listJalur.innerHTML = `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong class="d-block">Balikpapan - Samarinda</strong>
                        <small class="text-muted">Armada Aktif: ${armadaJalan} | Standby: ${armadaReady}</small>
                    </div>
                    <span class="badge bg-primary rounded-pill">Tersedia: 15 Ton</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong class="d-block">Balikpapan - Penajam</strong>
                        <small class="text-muted">Armada Aktif: 0 | Standby: 1</small>
                    </div>
                    <span class="badge bg-primary rounded-pill">Tersedia: 8 Ton</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong class="d-block">Balikpapan - Bontang</strong>
                        <small class="text-muted">Armada Aktif: 0 | Standby: 0</small>
                    </div>
                    <span class="badge bg-secondary rounded-pill">Penuh / Kosong</span>
                </li>
            `;
        }

        // Jalankan kalkulasi data saat halaman pertama dibuka
        muatUlangData();
    </script>
</body>
</html>