<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Penjualan</title>
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to the separated CSS file -->
</head>
<body>


    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard Penjualan</h2>
        <ul>
            <li><a href="{{ url(Auth::user()->role . '/home') }}">Home</a></li>
            <li><a href="{{ url(Auth::user()->role . '/produk') }}">Produk</a></li>
            <li><a href="#">Penjualan</a></li>
            <li><a href="{{ url(Auth::user()->role . '/laporan') }}">Laporan</a></li>
            <li>
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-decoration-none bg-transparent border-0 text-white" style="font-size 18px;">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header style="display: flex; justify-content: space-between">
            <div>
                <h1>Daftar Produk</h1>
                <p>Temukan produk terbaik untuk kebutuhan anda</p>
            </div>
            <div>
                <button class="card-button"><a class="text-decoration-none text-white" href="{{ url(Auth::user()->role . '/produk/add') }}">Add Product</a></button>
            </div>
        </header>


        <!-- Product Grid -->
        @foreach($produk as $item)

        <div class="product-grid">
            <!-- Product Card 1 -->
            <div class="product-card">
                <img src="{{ asset('storage/public/images/' . $item->image) }}" alt="Product Image">
                <h3>{{$item->nama_produk }}</h3>
                <p class="price">{{$item->harga }}</p>
                <p class="description">{{$item->deskripsi }}</p>
                {{-- <button class="card-button">Edit</button> --}}
                <div style="display: flex; justify-content: center">
                    <a class="btn btn-success mr-2" href="{{ url(Auth::user()->role . '/produk/edit/' . $item->kode_produk) }}">Edit</a>
                {{-- <button class="card-button">Delete</button> --}}
                <form action="{{ url(Auth::user()->role . '/produk/delete/' . $item->kode_produk) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </div>


        </div>
        @endforeach

    </div>


</body>
</html>
