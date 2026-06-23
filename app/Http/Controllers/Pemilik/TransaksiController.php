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

        // == LOGIKA BARU UNTUK EXPORT ==
        if ($request->has('action') && $request->action != '') {
            // 1. Ambil data terfilter beserta detailnya
            $dataUntukExport = $query->with('details')->get();

            // 2. Tentukan nama file dasar (Base Filename)
            $namaFile = 'Laporan-Transaksi';

            // Jika ada filter kata kunci pencarian
            if ($request->has('cari') && $request->cari != '') {
                $namaFile .= '_Cari-' . Str::slug($request->cari);
            }

            // Jika ada filter tanggal (Dari - Sampai)
            if ($request->has('start_date') && $request->start_date != '') {
                $namaFile .= '_Dari-' . $request->start_date;
            }
            if ($request->has('end_date') && $request->end_date != '') {
                $namaFile .= '_Sampai-' . $request->end_date;
            }

            // Jika tidak ada filter sama sekali, beri keterangan 'Semua'
            if (!$request->cari && !$request->start_date && !$request->end_date) {
                $namaFile .= '_Semua-Data';
            }

            // Tambahkan timestamp waktu unduh agar file tidak saling tumpang tindih
            $namaFile .= '_' . now()->format('Ymd_His');

            // 3. Proses Unduh berdasarkan tipe aksi
            if ($request->action == 'excel') {
                return Excel::download(new TransaksiExport($dataUntukExport), $namaFile . '.xlsx');
            }

            if ($request->action == 'pdf') {
                $pdf = FacadePdf::loadView('pemilik.transaksi.pdf', ['transaksi' => $dataUntukExport]);
                return $pdf->download($namaFile . '.pdf');
            }
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
