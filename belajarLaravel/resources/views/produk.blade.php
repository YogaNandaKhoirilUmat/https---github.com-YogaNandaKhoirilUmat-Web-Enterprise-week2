<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Penjualan</title>
    <link rel="stylesheet" href="{{ asset('/css/styles2.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to the separated CSS file -->
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard Penjualan</h2>
        <ul>
            <li><a href="{{ url('contoh') }}">Home</a></li>
            <li><a href="{{ url('produk') }}">Produk</a></li>
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

        <!-- Product Grid -->
        <div class="product-grid">

            <!-- Product Card 1 -->
            @foreach($produk as $item)
            <div class="product-card">
                <img src="https://via.placeholder.com/200" alt="Product 2">
                <h3>{{$item->nama_produk }}</h3>
                <p class="price">{{$item->harga }}</p>
                <p class="description">{{$item->deskripsi }}</p>
                <button class="card-button">Edit</button>
                <button class="card-button">Delete</button>
            </div>
            @endforeach


        </div>
    </div>


</body>
</html>
