<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;

class TransaksiKasirController extends Controller
{

    public function index()
    {
        $produks = Kategori::with('produk')->get();
        return view('kasir.transaksi', compact('produks'));
    }
}
