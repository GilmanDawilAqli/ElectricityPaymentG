<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemakaian</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #999;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        .header {
            text-align: center;
            font-weight: bold;
        }
        .status-lunas {
            color: green;
            font-weight: bold;
        }
        .status-belum {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2 class="header">Laporan Pemakaian Listrik</h2>

    <table>
        <tr>
            <th>No. Kontrol</th>
            <td>{{ $data->NoKontrol }}</td>
        </tr>
        <tr>
            <th>Nama Pelanggan</th>
            <td>{{ $data->pelanggan->Nama }}</td>
        </tr>
        <tr>
            <th>Bulan</th>
            <td>{{ $data->Bulan }}</td>
        </tr>
        <tr>
            <th>Tahun</th>
            <td>{{ $data->Tahun }}</td>
        </tr>
        <tr>
            <th>Meter Awal</th>
            <td>{{ $data->MeterAwal }}</td>
        </tr>
        <tr>
            <th>Meter Akhir</th>
            <td>{{ $data->MeterAkhir }}</td>
        </tr>
        <tr>
            <th>Biaya Beban</th>
            <td>Rp {{ number_format($data->BiayaBebanPemakai, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Biaya Pemakaian</th>
            <td>Rp {{ number_format($data->BiayaPemakaian, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Bayar</th>
            <td>Rp {{ number_format($data->JumlahPakai, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td class="{{ $data->Status == 'Lunas' ? 'status-lunas' : 'status-belum' }}">
                {{ $data->Status }}
            </td>
        </tr>
    </table>
</body>
</html>
