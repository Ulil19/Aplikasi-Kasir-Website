<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        tr {
            page-break-inside: avoid;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f1f5f9;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .detail-heading {
            background-color: #f8fafc;
            font-size: 10px;
            font-style: italic;
            color: #475569;
        }
    </style>
</head>

<body>
    <div class="title">LAPORAN DETAIL DATA TRANSAKSI</div>
    <p>Tanggal Cetak: {{ now()->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="25%">Info Transaksi</th>
                <th width="45%">Item Produk yang Dibeli</th>
                <th width="26%" class="text-right">Rincian Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $index => $trx)
                <tr>
                    <td class="text-center" valign="top">{{ $index + 1 }}</td>
                    <td valign="top">
                        <strong>{{ $trx->invoice }}</strong><br>
                        Kustomer: {{ $trx->customer ?? '-' }}<br>
                        <small style="color: #64748b;">{{ $trx->created_at->format('d-m-Y H:i') }}</small>
                    </td>
                    <td style="padding: 0;" valign="top">
                        <table style="width: 100%; margin: 0; border: none;">
                            <tr class="detail-heading">
                                <td style="border: none; border-bottom: 1px solid #e2e8f0;">Nama Produk</td>
                                <td style="border: none; border-bottom: 1px solid #e2e8f0;" class="text-center">Qty</td>
                                <td style="border: none; border-bottom: 1px solid #e2e8f0;" class="text-right">Subtotal
                                </td>
                            </tr>
                            @foreach ($trx->details as $detail)
                                <tr>
                                    <td style="border: none;">{{ $detail->nama_produk }}</td>
                                    <td style="border: none;" class="text-center">{{ $detail->jumlah }}</td>
                                    <td style="border: none;" class="text-right">Rp
                                        {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                    <td class="text-right" valign="top">
                        Total: <strong>Rp {{ number_format($trx->total, 0, ',', '.') }}</strong><br>
                        <small style="color: #475569;">Bayar: Rp
                            {{ number_format($trx->bayar, 0, ',', '.') }}</small><br>
                        <small style="color: #475569;">Kembali: Rp
                            {{ number_format($trx->kembalian, 0, ',', '.') }}</small>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
