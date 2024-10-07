<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ViewProduk()
    {
        $produk = Produk::all(); //mengambil semua data dari tabel produk
        return view('produk', ['produk' => $produk]); //menampilkan view dari produk.blade.php dengan membawa variabel $produk
    }
}
