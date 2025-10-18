document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('paymentsChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Total Payments',
                    data: chartValues,
                    backgroundColor: 'rgba(94, 114, 228, 0.1)',
                    borderColor: '#5e72e4',
                    borderWidth: 2,
                    pointBackgroundColor: '#5e72e4',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }
});
