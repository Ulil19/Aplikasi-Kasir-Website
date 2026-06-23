<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {

        $startDate = $request->filled('start_date')
            ? $request->input('start_date')
            : now()->startOfMonth()->format('Y-m-d');

        $endDate = $request->filled('end_date')
            ? $request->input('end_date')
            : now()->format('Y-m-d');

        // Filter Tanggal
        $queryBase = Transaksi::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);

        // EXPORT EXCEL & PDF
        if ($request->has('action') && $request->action != '') {
            $dataUntukExport = (clone $queryBase)->with('details')->get();
            $namaFile = 'Laporan-Transaksi_Dari-' . $startDate . '_Sampai-' . $endDate . '_' . now()->format('Ymd_His');

            if ($request->action == 'excel') {
                return Excel::download(new TransaksiExport($dataUntukExport), $namaFile . '.xlsx');
            }
            if ($request->action == 'pdf') {
                $pdf = FacadePdf::loadView('pemilik.laporan.pdf', ['transaksi' => $dataUntukExport]);
                return $pdf->download($namaFile . '.pdf');
            }
        }

        // MBIL DATA RINGKASAN
        $totalOmzet = (clone $queryBase)->sum('total');
        $totalTransaksi = (clone $queryBase)->count();

        // Ambil ID Transaksi dengan query bersih
        $transaksiIds = (clone $queryBase)->pluck('id');
        $totalItemTerjual = TransaksiDetail::whereIn('transaksi_id', $transaksiIds)->sum('jumlah');

        // OLAH DATA UNTUK GRAFIK (Menggunakan Clone Agar Tidak Merusak Query Lain)
        $transaksiPerHari = (clone $queryBase)
            ->selectRaw('DATE(created_at) as tanggal, SUM(total) as omzet')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $labels = [];
        $values = [];

        foreach ($transaksiPerHari as $data) {
            $labels[] = Carbon::parse($data->tanggal)->format('d M');
            $values[] = (float) $data->omzet;
        }

        $dataGrafik = [
            'labels' => $labels,
            'values' => $values
        ];

        // 5 PRODUK TERLARIS (IKUT FILTER TANGGAL)
        $produkTerlaris = TransaksiDetail::whereIn('transaksi_id', $transaksiIds)
            ->select('nama_produk', DB::raw('SUM(jumlah) as total_terjual'), DB::raw('SUM(subtotal) as total_pendapatan'))
            ->groupBy('nama_produk')
            ->orderBy('total_terjual', 'desc')
            ->take(5)
            ->get();

        //  PERFORMA PENJUALAN KASIR (IKUT FILTER TANGGAL) 
        $performaKasir = (clone $queryBase)
            ->selectRaw('user_id, COUNT(id) as total_transaksi, SUM(total) as total_omzet')
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'nama');
                }
            ])
            ->groupBy('user_id')
            ->orderBy('total_omzet', 'desc')
            ->get();

        return view('pemilik.laporan.index', compact(
            'totalOmzet',
            'totalTransaksi',
            'totalItemTerjual',
            'dataGrafik',
            'produkTerlaris',
            'performaKasir'
        ));
    }
}