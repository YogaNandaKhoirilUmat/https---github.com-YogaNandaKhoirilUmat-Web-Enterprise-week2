<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Penjualan</title>
    <link rel="stylesheet" href="{{ asset('/css/styles.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard Penjualan</h2>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Produk</a></li>
            <li><a href="#">Penjualan</a></li>
            <li><a href="#">Laporan</a></li>
            <li><a href="#">Pengaturan</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>Selamat Datang di Dashboard Penjualan</h1>
        </header>

        <!--stats Cards -->
        <div class="cards">
            <div class="card">
                <h3>Total Produk</h3>
                <p id="total-products">320</p>
            </div>
            <div class="card">
                <h3>Total Penjualan</h3>
                <p id="sales-today">100</p>
            </div>
            <div class="card">
                <h3>Total Pendapatan</h3>
                <p id="total-revenue">Rp. 50.000.000</p>
            </div>
            <div class="card">
                <h3>Pengguna Terdaftar</h3>
                <p id="registered-users">350</p>
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
            A simple primary alert—check it out!
        </div>

        <!-- Sales Chart -->
        <div class="chart">
            <h2>Grafik Penjualan Bulanan</h2>
            <canvas id="sales-chart"></canvas>
        </div>
    </div>

    <!--<script src="script.js"></script>-->
</body>
</html>
