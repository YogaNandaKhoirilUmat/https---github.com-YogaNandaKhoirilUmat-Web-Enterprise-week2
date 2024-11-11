<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ViewProduk()
    {
        // $produk = Produk::all(); //mengambil semua data dari tabel produk
        $isAdmin = Auth::user()->role == 'admin';
        //jika user adalah admin, maka tampilkan semua data, jika bukan admin, maka tampilkan data dengan user_id yang sama dengan user yang login
        $produk = $isAdmin ? Produk::all() : Produk::where('user_id', Auth::user()->id)->get();
        return view('produk', ['produk' => $produk]); //menampilkan view dari produk.blade.php dengan membawa variabel $produk
    }

    public function CreateProduk(Request $request)
    {
       //menambahkan variabel $filepath untuk mendefinisikan penyimpanan file
       $imageName = null;
       if ($request->hasFile('image')) {
           $imageFile = $request->file('image');
           $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
           $imageFile->storeAs('public\images', $imageName);
         }
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk,
            'image' => $imageName,
            'user_id' => Auth::user()->id
        ]);

        return redirect (Auth::user()->role.'/produk');
    }
    public function ViewAddProduk()
    {
        return view('addproduk'); //menampilkan view dari addProduk.blade.php
    }

    public function DeleteProduk($kode_produk)
    {
        Produk::where('kode_produk', $kode_produk)->delete(); //menghapus data produk berdasarkan kode_produk
        return redirect (Auth::user()->role.'/produk');
    }

    public function ViewEditProduk($kode_produk)
    {
        $ubahproduk = Produk::where('kode_produk', $kode_produk)->first();

        return view('editproduk', compact('ubahproduk'));//menampilkan view dari editProduk.blade.php dengan membawa variabel $ubahproduk
    }

    public function UpdateProduk(Request $request, $kode_produk)
    {
        //menambahkan variabel $filepath untuk mendefinisikan penyimpanan file
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->storeAs('public\images', $imageName);
        }
        Produk::where('kode_produk', $kode_produk)->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk,
            'image' => $imageName
        ]);

        return redirect (Auth::user()->role.'/produk');
    }

    public function ViewLaporan()
    {
        //mengambil semua data produk
        $produk = Produk::all();
        return view('laporan', ['produk' => $produk]); //menampilkan view dari laporan.blade.php dengan membawa variabel $produk
    }

    public function print ()
    {
        //mengambil semua data produk
        $products = Produk::all();

        //load view untuk pdf dengan data produk
        $pdf = Pdf::loadView('report', compact('products'));

        //menampilkan pdf langsung di browser
        return $pdf->stream('laporan-produk.pdf');
    }
}
