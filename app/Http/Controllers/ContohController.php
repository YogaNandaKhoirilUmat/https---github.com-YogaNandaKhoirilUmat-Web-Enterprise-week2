<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Carbon\Carbon;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function TampilContoh()
    {
        //cek apakah user adalah admin
        $isAdmin = Auth::user()->role == 'admin';

        //ambil produk dari database dan kelompokkan berdasarkan fungsi
        $produkPerHariQuery = Produk::selectraw('Date(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderby('date', 'desc');

            //filter by user_id jika user bukan admin
            if (!$isAdmin) {
                $produkPerHariQuery->where('user_id', Auth::id());
            }

            $produkPerHari = $produkPerHariQuery->get();

            //memisahkan data untuk grafik
            $dates = [];
            $totals = [];

            foreach ($produkPerHari as $item) {
                $dates[] = Carbon::parse($item->date)->format('Y-m-d'); //format tanggal
                $totals[] = $item->total;
            }

            //membuat grafik menggunakan data yang diambil
            $chart = LarapexChart::barChart()
                ->setTitle('Produk Ditambahkan Per Hari')
                ->setSubtitle('Data Penambahan Produk Harian')
                ->addData('Jumlah Produk', $totals)
                ->setXAxis($dates);

            //data tambahan untuk view
            $totalProductsQuery = Produk::query();

            //filter by user_id jika user bukan admin
            if (!$isAdmin) {
                $totalProductsQuery->where('user_id', Auth::id());
            }

            //data tambahan untuk view
            $data = [
                'totalProducts' => $totalProductsQuery->count(), //total produk
                'salesToday' => 130, //penjualan hari ini
                'totalRevenue' => 'Rp. 50.000.000', //total pendapatan
                'registeredUsers' => User::count(), //total user
                'chart' => $chart //pass chart ke view
            ];

            return view('contoh', $data);
    }
}
