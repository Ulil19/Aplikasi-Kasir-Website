import Chart from "chart.js/auto";

export function initLaporan() {
    const ctx = document.getElementById("omzetChart");
    if (!ctx) return; // Keluar fungsi jika tidak berada di halaman laporan

    const chartData = JSON.parse(ctx.getAttribute("data-chart") || "{}");

    new Chart(ctx, {
        type: "line",
        data: {
            labels: chartData.labels || [],
            datasets: [
                {
                    label: "Omzet Penjualan (Rp)",
                    data: chartData.values || [],
                    borderColor: "#0284c7",
                    backgroundColor: "rgba(2, 132, 199, 0.1)",
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return "Rp " + value.toLocaleString("id-ID");
                        },
                    },
                },
            },
        },
    });
}
