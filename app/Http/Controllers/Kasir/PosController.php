<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;


class PosController extends Controller
{
    // 
    public function index()
    {
        $kategori = Kategori::with('produk')->get();
        return view('kasir.transaksi', compact('kategori'));
    }

    // Proses Bayar
    public function prosesBayar(Request $request)
    {
        if (!$request->has('keranjang') || empty($request->keranjang)) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang belanja kosong atau tidak valid.'
            ], 400);
        }

        DB::beginTransaction();

        try {
            $keranjang = $request->keranjang;
            $totalTagihan = 0;
            foreach ($keranjang as $item) {
                $totalTagihan += $item['harga'] * $item['qty'];
            }

            $invoice = 'INV-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));

            $transaksi = new Transaksi();
            $transaksi->user_id = Auth::id();
            $transaksi->invoice = $invoice;
            $transaksi->customer = $request->input('kustomer', 'Umum');
            $transaksi->total = $totalTagihan;
            $transaksi->bayar = $request->input('bayar', $totalTagihan);
            $transaksi->kembalian = $transaksi->bayar - $transaksi->total;
            $transaksi->save();

            foreach ($keranjang as $item) {
                $detail = new TransaksiDetail();
                $detail->transaksi_id = $transaksi->id;
                $detail->produk_id = $item['id'];
                $detail->nama_produk = $item['nama'];
                $detail->harga = $item['harga'];
                $detail->jumlah = $item['qty'];
                $detail->subtotal = $item['harga'] * $item['qty'];
                $detail->save();

                // Opsional: Jika ada sistem stok, Anda bisa mengurangi stok produk di sini
                // $produk = Produk::find($item['id']);
                // $produk->decrement('stok', $item['qty']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil diproses.',
                'transaksi_id' => $transaksi->id
            ]);
        } catch (\Exception $e) {
            // Jika ada yang error, batalkan semua data yang sempat masuk
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }
}
