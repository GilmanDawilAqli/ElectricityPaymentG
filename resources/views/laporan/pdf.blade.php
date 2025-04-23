<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemakaian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 6px 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .right {
            text-align: right;
        }
    </style>
</head>
<body>

    {{-- Bagian LUNAS --}}
    @if (count($lunas) > 0)
    <h2>Laporan Pembayaran Lunas</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Kontrol</th>
                <th>Nama Pelanggan</th>
                <th>Bulan / Tahun</th>
                <th>Meter Awal</th>
                <th>Meter Akhir</th>
                <th>Biaya Beban</th>
                <th>Jumlah Tagihan</th>
                <th>Jumlah Bayar</th>
                <th>Kembalian</th>
                <th>Metode Pembayaran</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lunas as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->NoKontrol }}</td>
                    <td>{{ $item->pelanggan->Nama ?? '-' }}</td>
                    <td>{{ $item->Bulan }} / {{ $item->Tahun }}</td>
                    <td class="right">{{ $item->MeterAwal }}</td>
                    <td class="right">{{ $item->MeterAkhir }}</td>
                    <td class="right">Rp {{ number_format($item->BiayaBebanPemakai, 0, ',', '.') }}</td>
                    <td class="right">Rp {{ number_format($item->JumlahPakai, 0, ',', '.') }}</td>
                    <td class="right">Rp {{ number_format(optional($item->pembayaran)->JumlahBayar, 0, ',', '.') }}</td>
                    <td class="right">Rp {{ number_format(optional($item->pembayaran)->kembalian, 0, ',', '.') }}</td>
                    <td>{{ $item->pembayaran->MetodePembayaran ?? '-' }}</td>
                    <td>{{ $item->pembayaran->PetugasNama ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    {{-- Bagian BELUM LUNAS --}}
    @if (count($belumLunas) > 0)
    <h2>Laporan Pemakaian Belum Lunas</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Kontrol</th>
                <th>Nama Pelanggan</th>
                <th>Bulan / Tahun</th>
                <th>Meter Awal</th>
                <th>Meter Akhir</th>
                <th>Biaya Beban</th>
                <th>Jumlah Pakai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($belumLunas as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->NoKontrol }}</td>
                    <td>{{ $item->pelanggan->Nama ?? '-' }}</td>
                    <td>{{ $item->Bulan }} / {{ $item->Tahun }}</td>
                    <td class="right">{{ $item->MeterAwal }}</td>
                    <td class="right">{{ $item->MeterAkhir }}</td>
                    <td class="right">Rp {{ number_format($item->BiayaBebanPemakai, 0, ',', '.') }}</td>
                    <td class="right">Rp {{ number_format($item->JumlahPakai, 0, ',', '.') }}</td>
                    <td>{{ $item->status ?? 'Belum Lunas' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</body>
</html>

