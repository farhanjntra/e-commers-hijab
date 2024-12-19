@extends('admin.layout.index')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Dashboard Admin</h1>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text">{{ $totalBarang }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Grafik Statistik</h5>
                    <canvas id="statistikChart" width="800" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Grafik Chart.js -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('statistikChart').getContext('2d');
        const statistikChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Orders', 'Barang', 'Users'],
                datasets: [{
                    label: 'Jumlah Data',
                    data: [{{ $totalOrders }}, {{ $totalBarang }}, {{ $totalUsers }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',   // Biru
                        'rgba(75, 192, 192, 0.6)',   // Hijau
                        'rgba(255, 159, 64, 0.6)'    // Orange
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
