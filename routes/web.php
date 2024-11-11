<?php

use App\Http\Controllers\ContohController;
use App\Http\Controllers\ProdukController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/contoh', function () {
//     return view('contoh');
// });



// Route::get('/home', [ContohController::class, 'TampilContoh']);
// Route::get('/produk', [ProdukController::class, 'ViewProduk']);
// Route::get('/produk/add', [ProdukController::class, 'ViewAddProduk']);
// Route::post('/produk/add', [ProdukController::class, 'CreateProduk']);
// Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);
// Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);
// Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);

// Route::get('/laporan', [ProdukController::class, 'ViewLaporan']);
// Route::get('/report', [ProdukController::class, 'print']);


// Route::get('/produk', function () {
//     return view('produk');
// });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Route untuk user
Route::middleware(['auth', 'user-access:user'])->prefix('user')->group(function () {
Route::get('/home', [HomeController::class, 'ViewHome']);
Route::get('/produk', [ProdukController::class, 'ViewProduk']);
Route::get('/produk/add', [ProdukController::class, 'ViewAddProduk']);
Route::post('/produk/add', [ProdukController::class, 'CreateProduk']);

Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);
Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);
Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);

Route::get('/laporan', [ProdukController::class, 'ViewLaporan']);
Route::get('/report', [ProdukController::class, 'print']);

});


//Route untuk admin
Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function () {
Route::get('/home', [HomeController::class, 'ViewHome']);
Route::get('/produk', [ProdukController::class, 'ViewProduk']);
Route::get('/produk/add', [ProdukController::class, 'ViewAddProduk']);
Route::post('/produk/add', [ProdukController::class, 'CreateProduk']);

Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);
Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);
Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);

Route::get('/laporan', [ProdukController::class, 'ViewLaporan']);
Route::get('/report', [ProdukController::class, 'print']);

});
