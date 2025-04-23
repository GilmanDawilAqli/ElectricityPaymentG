<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Filter berdasarkan status
        $status = $request->get('status');
        $query = Pemakaian::with('pelanggan');

        if ($status) {
            $query->where('status', $status);
        }

        $pemakaian = $query->get();

        return view('laporan', compact('pemakaian'));
    }

    public function generateLunasSingle($id)
    {
        $pembayaran = DB::table('pembayaran')
            ->join('pemakaian', 'pembayaran.pemakaian_id', '=', 'pemakaian.id')
            ->join('pelanggan', 'pemakaian.NoKontrol', '=', 'pelanggan.NoKontrol')
            ->select(
                'pembayaran.petugas_id as IDPetugas',
                'pembayaran.PetugasNama as NamaPetugas',
                'pemakaian.id as IDPemakaian',
                'pemakaian.Tahun',
                'pemakaian.Bulan',
                'pemakaian.NoKontrol',
                'pelanggan.Nama',
                'pemakaian.MeterAwal',
                'pemakaian.MeterAkhir',
                'pemakaian.BiayaBebanPemakai',
                'pembayaran.JumlahTagihan',
                'pembayaran.MetodePembayaran',
                'pembayaran.JumlahTagihan',
                'pembayaran.JumlahBayar',
                'pembayaran.kembalian')
            ->where('pemakaian.status', 'Lunas')
            ->where('pemakaian.id', $id)
            ->get();

        if ($pembayaran->isEmpty()) return abort(404);

        $pdf = Pdf::loadView('laporan.lunas', compact('pembayaran'))
        ->setPaper('a4', 'landscape') // Ubah orientasi
        ->setOptions([
            'defaultPaperSize' => 'a4',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'margin-top' => 5,
            'margin-bottom' => 5,
            'margin-left' => 5,
            'margin-right' => 5,
        ]);
    
        return $pdf->download("laporan-pembayaran-lunas-$id.pdf");
    }

    public function generateBelumLunasSingle($id)
    {
        $pemakaian = DB::table('pemakaian')
            ->join('pelanggan', 'pemakaian.NoKontrol', '=', 'pelanggan.NoKontrol')
            ->select(
                'pemakaian.id as IDPemakaian',
                'pemakaian.Tahun',
                'pemakaian.Bulan',
                'pemakaian.NoKontrol',
                'pelanggan.Nama',
                'pemakaian.MeterAwal',
                'pemakaian.MeterAkhir',
                'pemakaian.BiayaBebanPemakai',
                'pemakaian.JumlahPakai',
                'pemakaian.status'
            )
            ->where('pemakaian.status', 'Belum Lunas')
            ->where('pemakaian.id', $id)
            ->get();

        if ($pemakaian->isEmpty()) return abort(404);

        $pdf = Pdf::loadView('laporan.BelumLunas', compact('pemakaian'));
        return $pdf->download("laporan-pembayaran-belum-lunas-$id.pdf");
    }

    public function generateAll(Request $request)
    {
        $status = $request->query('status');

        if (!$status || !in_array($status, ['Lunas', 'Belum Lunas'])) {
            return redirect()->back()->with('error', 'Silakan pilih status terlebih dahulu.');
        }

        if ($status === 'Lunas') {
            $data = DB::table('pembayaran')
                ->join('pemakaian', 'pembayaran.pemakaian_id', '=', 'pemakaian.id')
                ->join('pelanggan', 'pemakaian.NoKontrol', '=', 'pelanggan.NoKontrol')
                ->where('pemakaian.status', 'Lunas')
                ->select(
                    'pembayaran.petugas_id as IDPetugas',
                    'pembayaran.PetugasNama as NamaPetugas',
                    'pemakaian.id as IDPemakaian',
                    'pemakaian.Tahun',
                    'pemakaian.Bulan',
                    'pemakaian.NoKontrol',
                    'pelanggan.Nama',
                    'pemakaian.MeterAwal',
                    'pemakaian.MeterAkhir',
                    'pemakaian.BiayaBebanPemakai',
                    'pembayaran.JumlahTagihan',
                    'pembayaran.MetodePembayaran',
                    'pembayaran.JumlahTagihan',
                    'pembayaran.JumlahBayar',
                    'pembayaran.kembalian'
                )
                ->get();

                $pdf = Pdf::loadView('laporan.lunas', ['pembayaran' => $data])
                ->setPaper('a4', 'landscape')
                ->setOptions([
                    'defaultPaperSize' => 'a4',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'margin-top' => 5,
                    'margin-bottom' => 5,
                    'margin-left' => 5,
                    'margin-right' => 5,
                ]);
            
            return $pdf->download('laporan-semua-lunas.pdf');
            
        } else {
            $data = DB::table('pemakaian')
                ->join('pelanggan', 'pemakaian.NoKontrol', '=', 'pelanggan.NoKontrol')
                ->where('pemakaian.status', 'Belum Lunas')
                ->select(
                    'pemakaian.id as IDPemakaian',
                    'pemakaian.Tahun',
                    'pemakaian.Bulan',
                    'pemakaian.NoKontrol',
                    'pelanggan.Nama',
                    'pemakaian.MeterAwal',
                    'pemakaian.MeterAkhir',
                    'pemakaian.BiayaBebanPemakai',
                    'pemakaian.JumlahPakai',
                    'pemakaian.status'
                )
                ->get();

            $pdf = Pdf::loadView('laporan.BelumLunas', ['pemakaian' => $data]);
            return $pdf->download('laporan-semua-belum-lunas.pdf');
        }
    }

}