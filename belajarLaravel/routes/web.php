<?php

use App\Http\Controllers\ContohController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/contoh', function () {
//     return view('contoh');
// });



Route::get('/contoh', [ContohController::class, 'TampilContoh']);
Route::get('/produk', [ProdukController::class, 'ViewProduk']);

// Route::get('/produk', function () {
//     return view('produk');
// });
