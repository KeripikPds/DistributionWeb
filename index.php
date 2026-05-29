<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispatcher Dashboard - Fleet Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .table tr {
            transition: background-color 0.2s ease;
        }
        .table tr:hover {
            background-color: #f1f5f9;
        }
        .btn-group .btn {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 8px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
        }
        #logTracking {
            background-color: #fff3cd;
            color: #664d03;
            padding: 10px;
            border-left: 4px solid #ffc107;
            border-radius: 4px;
            display: none;
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">🚚 LogiTrack (Dispatcher)</a>
            <span class="navbar-text text-white bg-dark px-3 py-1 rounded-pill">Mode Operasional Manual</span>
        </div>
    </nav>

    <div class="container-fluid my-4 px-4">
        <div class="row">
            
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold text-success">➕ Registrasi / Tambah Armada Baru</div>
                    <div class="card-body">
                        <form id="formArmada">
                            <div class="mb-3">
                                <label class="form-label">Nomor Polisi</label>
                                <input type="text" class="form-control" id="addNopol" placeholder="Contoh: KT 1234 AB" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipe & Kapasitas</label>
                                <input type="text" class="form-control" id="addTipe" placeholder="Contoh: Wingbox (15 Ton)" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Simpan Armada Baru</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold text-primary">📍 Input Trip Baru</div>
                    <div class="card-body">
                        <form id="formTrip">
                            <div class="mb-3">
                                <label class="form-label">Pilih Armada</label>
                                <select class="form-select" id="tripArmada" required>
                                    </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jalur Operasional</label>
                                <select class="form-select" id="tripJalur" required>
                                    <option value="Balikpapan-Samarinda">Balikpapan - Samarinda</option>
                                    <option value="Balikpapan-Penajam">Balikpapan - Penajam</option>
                                    <option value="Balikpapan-Bontang">Balikpapan - Bontang</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Driver</label>
                                <input type="text" class="form-control" id="tripDriver" placeholder="Contoh: Budi Santoso" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Biaya Perjalanan (Rp)</label>
                                <input type="number" class="form-control" id="tripBiaya" placeholder="Contoh: 1500000" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Catat Penugasan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold text-dark d-flex justify-content-between align-items-center">
                        <span>📋 Manajemen & Monitoring Data Armada</span>
                        <span class="badge bg-secondary" id="totalUnitText">Total: 0 Unit</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No. Polisi</th>
                                    <th>Tipe & Kapasitas</th>
                                    <th>Status Saat Ini</th>
                                    <th class="text-center">Aksi Cepat Status (Update)</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody id="tabelArmada">
                                </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold text-primary d-flex justify-content-between align-items-center">
                        <span>📊 Riwayat & Status Penugasan Trip</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                            <thead class="table-light">
                                <tr>
                                    <th>Armada</th>
                                    <th>Jalur Operasional</th>
                                    <th>Driver</th>
                                    <th>Biaya</th>
                                    <th>Status Trip</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody id="tabelTrip">
                                </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold text-secondary">📍 Update Posisi Terakhir (Tracking Manual)</div>
                    <div class="card-body">
                        <div class="input-group">
                            <select class="form-select" id="trackArmada">
                                </select>
                            <input type="text" class="form-control" id="trackLokasi" placeholder="Lokasi Terakhir (cth: Rest Area KM 54)">
                            <button class="btn btn-secondary" onclick="updateTracking()">Simpan Posisi</button>
                        </div>
                        <small class="text-muted mt-3" id="logTracking"></small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // DATA MASTER (READ ATAU DEFAULTS)
        let armadaData = JSON.parse(localStorage.getItem('armadaData')) || [
            { nopol: 'B 1234 ABC', tipe: 'Wingbox (15 Ton)', status: 'Siap Beroperasi' },
            { nopol: 'KT 8888 XF', tipe: 'CDE Box (2.5 Ton)', status: 'Sedang dalam Perjalanan' },
            { nopol: 'L 9012 UV', tipe: 'Fuso (8 Ton)', status: 'Rusak/Perbaikan' }
        ];

        // Struktur log list data trip penugasan armada
        let listTripData = JSON.parse(localStorage.getItem('listTripData')) || [
            { nopol: 'KT 8888 XF', jalur: 'Balikpapan-Samarinda', driver: 'Andi Wijaya', biaya: 1200000, statusTrip: 'Dalam Perjalanan' }
        ];

        let tripStats = JSON.parse(localStorage.getItem('tripStats')) || { totalTrip: 1, totalBiaya: 1200000 };

        // FUNGSI UTAMA: REFRESH TAMPILAN (READ DATA)
        function refreshAplikasi() {
            // Simpan state ke localStorage
            localStorage.setItem('armadaData', JSON.stringify(armadaData));
            localStorage.setItem('listTripData', JSON.stringify(listTripData));
            localStorage.setItem('tripStats', JSON.stringify(tripStats));
            
            const tabel = document.getElementById('tabelArmada');
            const tabelTrip = document.getElementById('tabelTrip');
            const selectTrip = document.getElementById('tripArmada');
            const selectTrack = document.getElementById('trackArmada');
            const totalUnitText = document.getElementById('totalUnitText');
            
            tabel.innerHTML = '';
            tabelTrip.innerHTML = '';
            selectTrip.innerHTML = '';
            selectTrack.innerHTML = '';
            
            totalUnitText.innerText = `Total: ${armadaData.length} Unit`;

            // 1. RENDER TABEL ARMADA
            if(armadaData.length === 0) {
                tabel.innerHTML = `<tr><td colspan="5" class="text-center text-muted py-3">Tidak ada data armada.</td></tr>`;
            } else {
                armadaData.forEach((item, index) => {
                    let badgeColor = 'danger';
                    if (item.status === 'Siap Beroperasi') badgeColor = 'success';
                    if (item.status === 'Sedang dalam Perjalanan') badgeColor = 'warning text-dark';

                    tabel.innerHTML += `
                        <tr>
                            <td><strong class="text-uppercase">${item.nopol}</strong></td>
                            <td>${item.tipe}</td>
                            <td><span class="badge bg-${badgeColor}">${item.status}</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-success ${item.status === 'Siap Beroperasi' ? 'active' : ''}" onclick="updateStatus(${index}, 'Siap Beroperasi')">Ready</button>
                                    <button class="btn btn-outline-warning ${item.status === 'Sedang dalam Perjalanan' ? 'active' : ''}" onclick="updateStatus(${index}, 'Sedang dalam Perjalanan')">Jalan</button>
                                    <button class="btn btn-outline-danger ${item.status === 'Rusak/Perbaikan' ? 'active' : ''}" onclick="updateStatus(${index}, 'Rusak/Perbaikan')">Rusak</button>
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger" onclick="deleteArmada(${index})">🗑️ Hapus</button>
                            </td>
                        </tr>
                    `;
                    selectTrip.innerHTML += `<option value="${item.nopol}">${item.nopol} [${item.tipe}]</option>`;
                    selectTrack.innerHTML += `<option value="${item.nopol}">${item.nopol}</option>`;
                });
            }

            // 2. RENDER TABEL TRANSAKSI TRIP
            if(listTripData.length === 0) {
                tabelTrip.innerHTML = `<tr><td colspan="6" class="text-center text-muted py-3">Belum ada aktivitas perjalanan saat ini.</td></tr>`;
            } else {
                listTripData.forEach((trip, tIndex) => {
                    let tripBadge = trip.statusTrip === 'Selesai' ? 'bg-success' : 'bg-warning text-dark';
                    let actionButton = trip.statusTrip === 'Dalam Perjalanan' 
                        ? `<button class="btn btn-sm btn-success" onclick="selesaikanTrip(${tIndex}, '${trip.nopol}')">✓ Selesai</button>` 
                        : `<span class="text-muted small">N/A</span>`;

                    tabelTrip.innerHTML += `
                        <tr>
                            <td><strong>${trip.nopol}</strong></td>
                            <td>${trip.jalur}</td>
                            <td>${trip.driver}</td>
                            <td>Rp ${trip.biaya.toLocaleString('id-ID')}</td>
                            <td><span class="badge ${tripBadge}">${trip.statusTrip}</span></td>
                            <td class="text-center">${actionButton}</td>
                        </tr>
                    `;
                });
            }
        }

        // CREATE ARMADA
        document.getElementById('formArmada').addEventListener('submit', function(e) {
            e.preventDefault();
            let nopolInput = document.getElementById('addNopol').value.trim();
            let tipeInput = document.getElementById('addTipe').value.trim();

            if(armadaData.some(a => a.nopol.toLowerCase() === nopolInput.toLowerCase())) {
                alert('Armada sudah terdaftar!');
                return;
            }

            armadaData.push({ nopol: nopolInput, tipe: tipeInput, status: 'Siap Beroperasi' });
            refreshAplikasi();
            this.reset();
        });

        // UPDATE STATUS ARMADA
        function updateStatus(index, statusBaru) {
            armadaData[index].status = statusBaru;
            refreshAplikasi();
        }

        // DELETE ARMADA
        function deleteArmada(index) {
            if(confirm(`Hapus armada ${armadaData[index].nopol}?`)) {
                armadaData.splice(index, 1);
                refreshAplikasi();
            }
        }

        // CREATE TRIP BARU
        document.getElementById('formTrip').addEventListener('submit', function(e) {
            e.preventDefault();
            let selectedNopol = document.getElementById('tripArmada').value;
            let jalur = document.getElementById('tripJalur').value;
            let driver = document.getElementById('tripDriver').value.trim();
            let biaya = parseInt(document.getElementById('tripBiaya').value);

            // Ubah status armada menjadi 'Sedang dalam Perjalanan'
            let armadaIndex = armadaData.findIndex(a => a.nopol === selectedNopol);
            if(armadaIndex !== -1) armadaData[armadaIndex].status = 'Sedang dalam Perjalanan';

            // Masukkan record ke daftar data trip
            listTripData.push({
                nopol: selectedNopol,
                jalur: jalur,
                driver: driver,
                biaya: biaya,
                statusTrip: 'Dalam Perjalanan'
            });

            // Akumulasi total stat global untuk Admin
            tripStats.totalTrip += 1;
            tripStats.totalBiaya += biaya;
            
            refreshAplikasi();
            alert('Sukses: Trip baru dicatat dan tampil di daftar bawah!');
            this.reset();
        });

        // UPDATE STATUS TRIP (MENJADI SELESAI)
        function selesaikanTrip(tIndex, nopol) {
            // Ubah status internal trip
            listTripData[tIndex].statusTrip = 'Selesai';
            
            // Kembalikan status armada terkait menjadi 'Siap Beroperasi' kembali
            let armadaIndex = armadaData.findIndex(a => a.nopol === nopol);
            if(armadaIndex !== -1 && armadaData[armadaIndex].status === 'Sedang dalam Perjalanan') {
                armadaData[armadaIndex].status = 'Siap Beroperasi';
            }
            
            refreshAplikasi();
            alert(`Trip armada ${nopol} telah diselesaikan. Status armada kembali "Ready".`);
        }

        // TRACKING MANUAL LOG
        function updateTracking() {
            let nopol = document.getElementById('trackArmada').value;
            let lokasi = document.getElementById('trackLokasi').value.trim();
            if(!lokasi) return alert('Silakan isi lokasi.');
            
            let logBox = document.getElementById('logTracking');
            logBox.style.display = 'block';
            logBox.innerText = `[LOG ${new Date().toLocaleTimeString('id-ID')}] Armada ${nopol} berada di: ${lokasi}`;
            document.getElementById('trackLokasi').value = '';
        }

        refreshAplikasi();
    </script>
</body>
</html>