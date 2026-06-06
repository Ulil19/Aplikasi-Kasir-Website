<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{

    public function index()
    {
        $produk = Produk::all();
        return view('pemilik.produk.index', compact('produk'));
    }

    // Tambah produk baru
    public function simpan()
    {

    }

    // Edit produk
    public function update($id)
    {

    }

    // Hapus produk
    public function hapus($id)
    {

    }

    public function restore($id)
    {

    }


}
