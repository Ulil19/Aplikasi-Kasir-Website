<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Str;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class TransaksiController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Transaksi::query();

        // 1. Filter Pencarian (Invoice atau Customer)
        if ($request->has('cari') && $request->cari != '') {
            $query->where(function ($q) use ($request) {
                $q->where('invoice', 'like', '%' . $request->cari . '%')
                    ->orWhere('customer', 'like', '%' . $request->cari . '%');
            });
        }

        // 2. Filter Tanggal Mulai
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        // 3. Filter Tanggal Selesai
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // 4. Filter Urutan (Sorting)
        $sort = $request->input('sort', 'latest'); // default terbaru
        if ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort == 'highest') {
            $query->orderBy('total', 'desc');
        } else {
            $query->orderBy('created_at', 'desc'); // latest
        }

        // Ambil data dengan pagination (misal 10 data per halaman)
        $transaksi = $query->paginate(10);

        return view('pemilik.transaksi.index', compact('transaksi'));
    }

    public function detail($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        return view('pemilik.transaksi.detail', compact('transaksi'));
    }
}
