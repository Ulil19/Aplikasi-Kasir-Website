<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $hariIni = now()->toDateString();

        // 1. Total Omzet Pendapatan Hari Ini (Rupiah)
        $omzetHariIni = Transaksi::whereDate('created_at', $hariIni)->sum('total');

        // 2. Total Jumlah Transaksi/Nota Hari Ini
        $transaksiCount = Transaksi::whereDate('created_at', $hariIni)->count();

        // 3. Produk Terlaris Khusus Hari Ini
        $produkterlaris = TransaksiDetail::whereDate('created_at', $hariIni)
            ->select('nama_produk', DB::raw('SUM(jumlah) as total_terjual'))
            ->groupBy('nama_produk')
            ->orderBy('total_terjual', 'desc')
            ->first();

        return view('pemilik.index', compact('omzetHariIni', 'transaksiCount', 'produkterlaris'));
    }
}