<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\models\transaksi;
use App\Models\TransaksiDetail;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        $produkterlaris = Produk::withCount('transaksiDetails as total_terjual')
            ->orderBydesc('total_terjual')
            ->first();

        $transaksiCount = Transaksi::count();
        $transaksiDetailCount = TransaksiDetail::count();

        return view('pemilik.index', compact('transaksiCount', 'transaksiDetailCount', 'produkterlaris'));
    }
}
