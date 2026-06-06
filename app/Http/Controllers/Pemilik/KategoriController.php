<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all();
        return view('pemilik.kategori.index', compact('kategori'));
    }

    //
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
