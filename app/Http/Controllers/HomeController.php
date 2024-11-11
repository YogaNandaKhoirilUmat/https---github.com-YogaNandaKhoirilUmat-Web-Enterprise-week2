<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Carbon\Carbon;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function ViewHome()
    {
        // Cek apakah user adalah admin
        $isAdmin = Auth::user()->role == 'admin';

        // Ambil produk dari database dan kelompokkan berdasarkan tanggal
        $produkPerHariQuery = Produk::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc');

        // Filter by user_id jika user bukan admin
        if (!$isAdmin) {
            $produkPerHariQuery->where('user_id', Auth::id());
        }

        $produkPerHari = $produkPerHariQuery->get();

        // Memisahkan data untuk grafik
        $dates = [];
        $totals = [];

        foreach ($produkPerHari as $item) {
            $dates[] = Carbon::parse($item->date)->format('Y-m-d'); // Format tanggal
            $totals[] = $item->total;
        }

        // Membuat grafik menggunakan data yang diambil
        $chart = LarapexChart::barChart()
            ->setTitle('Produk Ditambahkan Per Hari')
            ->setSubtitle('Data Penambahan Produk Harian')
            ->addData('Jumlah Produk', $totals)
            ->setXAxis($dates);

        // Menghitung total produk
        $totalProductsQuery = Produk::query();

        // Filter by user_id jika user bukan admin
        if (!$isAdmin) {
            $totalProductsQuery->where('user_id', Auth::id());
        }

        // Data tambahan untuk view
        $data = [
            'totalProducts' => $totalProductsQuery->count(), // Total produk
            'salesToday' => 130, // Penjualan hari ini (data contoh)
            'totalRevenue' => 'Rp. 50.000.000', // Total pendapatan (data contoh)
            'registeredUsers' => User::count(), // Total user terdaftar
            'chart' => $chart // Pass chart ke view
        ];

        return view('home', $data); // Ganti 'home' sesuai dengan nama view Anda
    }
}
