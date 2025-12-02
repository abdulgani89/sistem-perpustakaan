// Tunggu sampai DOM dan Chart.js ready
document.addEventListener('DOMContentLoaded', function() {
    // Ambil data dari data attributes di body
    const body = document.body;
    
    const labels = JSON.parse(body.getAttribute('data-chart-labels') || '[]');
    const peminjam = JSON.parse(body.getAttribute('data-chart-peminjam') || '[]');
    const hilang = JSON.parse(body.getAttribute('data-chart-hilang') || '[]');
    const bukuTersedia = parseInt(body.getAttribute('data-buku-tersedia') || '0');
    const bukuDipinjam = parseInt(body.getAttribute('data-buku-dipinjam') || '0');
    const bukuHilang = parseInt(body.getAttribute('data-buku-hilang') || '0');

    const ctx1 = document.getElementById('chartPeminjamPerBulan');
    if (ctx1) {
        new Chart(ctx1.getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Peminjam',
                    data: peminjam,
                    backgroundColor: 'rgba(0, 119, 182, 0.1)',
                    borderColor: 'rgba(0, 119, 182, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(0, 119, 182, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                }
            }
        });
    }

    const ctx2 = document.getElementById('chartBukuHilangPerBulan');
    if (ctx2) {
        new Chart(ctx2.getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Buku Hilang',
                    data: hilang,
                    backgroundColor: 'rgba(220, 38, 38, 0.1)',
                    borderColor: 'rgba(220, 38, 38, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(220, 38, 38, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        maxTicksLimit: 50,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                }
            }
        });
    }

    const ctx3 = document.getElementById('chartStatusBuku');
    if (ctx3) {
        new Chart(ctx3.getContext('2d'), {
            type: 'polarArea',
            data: {
                labels: ['Buku Tersedia', 'Buku Dipinjam', 'Buku Hilang'],
                datasets: [{
                    label: 'Jumlah Buku',
                    data: [bukuTersedia, bukuDipinjam, bukuHilang],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(220, 38, 38, 0.7)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(220, 38, 38, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' buku';
                            }
                        }
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    }
});
