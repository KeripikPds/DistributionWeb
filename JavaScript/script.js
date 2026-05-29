<script>
        // Data Awal Mockup (Disimpan di localStorage agar sinkron dengan Admin)
        let armadaData = JSON.parse(localStorage.getItem('armadaData')) || [
            { nopol: 'B 1234 ABC', tipe: 'Wingbox (15 Ton)', status: 'Siap Beroperasi' },
            { nopol: 'KT 8888 XF', tipe: 'CDE Box (2.5 Ton)', status: 'Sedang dalam Perjalanan' },
            { nopol: 'L 9012 UV', tipe: 'Fuso (8 Ton)', status: 'Rusak/Perbaikan' }
        ];

        let tripStats = JSON.parse(localStorage.getItem('tripStats')) || { totalTrip: 42, totalBiaya: 63000000 };

        function renderArmada() {
            localStorage.setItem('armadaData', JSON.stringify(armadaData));
            const tabel = document.getElementById('tabelArmada');
            tabel.innerHTML = '';
            
            armadaData.forEach((item, index) => {
                let badgeColor = item.status === 'Siap Beroperasi' ? 'success' : (item.status === 'Sedang dalam Perjalanan' ? 'warning text-dark' : 'danger');
                tabel.innerHTML += `
                    <tr>
                        <td><strong>${item.nopol}</strong></td>
                        <td>${item.tipe}</td>
                        <td><span class="badge bg-${badgeColor}">${item.status}</span></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-success" onclick="updateStatus(${index}, 'Siap Beroperasi')">Ready</button>
                                <button class="btn btn-outline-warning" onclick="updateStatus(${index}, 'Sedang dalam Perjalanan')">Jalan</button>
                                <button class="btn btn-outline-danger" onclick="updateStatus(${index}, 'Rusak/Perbaikan')">Rusak</button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        function updateStatus(index, statusBaru) {
            armadaData[index].status = statusBaru;
            renderArmada();
        }

        document.getElementById('formTrip').addEventListener('submit', function(e) {
            e.preventDefault();
            tripStats.totalTrip += 1;
            tripStats.totalBiaya += parseInt(document.getElementById('tripBiaya').value);
            localStorage.setItem('tripStats', JSON.stringify(tripStats));
            
            alert('Sukses: Trip baru berhasil dicatat ke sistem! Silakan buka halaman Admin untuk melihat pembaruan data.');
            this.reset();
        });

        function updateTracking() {
            let nopol = document.getElementById('trackArmada').value;
            let lokasi = document.getElementById('trackLokasi').value;
            if(!lokasi) return alert('Isi lokasi terlebih dahulu');
            document.getElementById('logTracking').innerText = `Log Terakhir: ${nopol} dilaporkan berada di [ ${lokasi} ] pada pukul ${new Date().toLocaleTimeString('id-ID')}`;
            document.getElementById('trackLokasi').value = '';
        }

        // Jalankan saat load awal
        renderArmada();
    </script>