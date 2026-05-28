// Chart Utilisasi Armada
const ctxUtil = document.getElementById("utilisasiChart").getContext("2d");
new Chart(ctxUtil, {
  type: "doughnut",
  data: {
    labels: ["Aktif", "Standby", "Idle"],
    datasets: [
      {
        data: [12, 5, 3],
        backgroundColor: ["#0d6efd", "#198754", "#ffc107"],
      },
    ],
  },
  options: {
    responsive: true,
    plugins: { legend: { position: "bottom" } },
  },
});

// Chart Trip per Rute
const ctxTrip = document.getElementById("tripChart").getContext("2d");
new Chart(ctxTrip, {
  type: "bar",
  data: {
    labels: ["Jakarta-Bandung", "Surabaya-Malang", "Medan-Pekanbaru"],
    datasets: [
      {
        label: "Jumlah Trip",
        data: [12, 8, 14],
        backgroundColor: "#0d6efd",
      },
    ],
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: { y: { beginAtZero: true } },
  },
});
