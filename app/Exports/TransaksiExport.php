<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;
    private $rowNumber = 0;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Memecah data agar baris Excel di-loop berdasarkan item detail produk
        $rows = collect();
        foreach ($this->data as $trx) {
            foreach ($trx->details as $detail) {
                $rows->push([
                    'trx' => $trx,
                    'detail' => $detail
                ]);
            }
        }
        return $rows;
    }

    public function headings(): array
    {
        return [
            'No',
            'Invoice',
            'Customer',
            'Nama Produk',
            'Harga Satuan',
            'Jumlah (Qty)',
            'Subtotal Produk',
            'Total Bayar Transaksi',
            'Bayar',
            'Kembalian',
            'Tanggal',
        ];
    }

    public function map($row): array
    {
        $trx = $row['trx'];
        $detail = $row['detail'];

        return [
            ++$this->rowNumber,
            $trx->invoice,
            $trx->customer,
            $detail->nama_produk,
            $detail->harga,
            $detail->jumlah,
            $detail->subtotal,
            $trx->total,
            $trx->bayar,
            $trx->kembalian,
            $trx->created_at->format('d-m-Y H:i'),
        ];
    }
}