<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemakaian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    public function index()
    {
        $pemakaian = Pemakaian::with('pelanggan')->get(); // Pastikan relasi pelanggan dimuat
        return view('pemakaian', compact('pemakaian'));
    }

    public function create()
    {
        $bulanList = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];
    
        $tahunSekarang = Carbon::now()->year;
        $bulanSekarang = Carbon::now()->format('m');
    
        $pelangganList = Pelanggan::all(); // jika kamu punya relasi pelanggan
    
        return view('CRUD.pemakaian.cu-pemakaian', compact('bulanList', 'tahunSekarang', 'bulanSekarang', 'pelangganList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Tahun' => 'required|integer|min:1900',
            'Bulan' => 'required|integer|min:1|max:12',
            'NoKontrol' => 'required|string|exists:pelanggan,NoKontrol',
            'MeterAwal' => 'required|integer',
            'MeterAkhir' => 'required|integer|gte:MeterAwal',
            'BiayaBebanPemakai' => 'required|numeric',
            'BiayaPemakaian' => 'required|numeric',
        ]);

        $cekDuplikat = Pemakaian::where('NoKontrol', $request->NoKontrol)
        ->where('Tahun', $request->Tahun)
        ->where('Bulan', $request->Bulan)
        ->exists();

        if ($cekDuplikat) {
            return back()->withErrors(['Bulan' => 'Data pemakaian untuk bulan ini sudah ada untuk pelanggan ini.'])->withInput();
        }


        $jumlahPakai = $request->MeterAkhir - $request->MeterAwal;

        Pemakaian::create([
            'NoKontrol' => $request->NoKontrol,
            'Tahun' => $request->Tahun,
            'Bulan' => $request->Bulan,
            'MeterAwal' => $request->MeterAwal,
            'MeterAkhir' => $request->MeterAkhir,
            'JumlahPakai' => $jumlahPakai,
            'BiayaBebanPemakai' => $request->BiayaBebanPemakai,
            'BiayaPemakaian' => $request->BiayaPemakaian,
            'Status' => 'Belum Lunas',
        ]);
        return redirect()->route('pemakaian.index')->with('success', 'Data berhasil ditambahkan.');
    }
    
    public function destroy($tahun, $bulan, $NoKontrol)
    {
        $pemakaian = Pemakaian::where('Tahun', $tahun)
            ->where('Bulan', $bulan)
            ->where('NoKontrol', $NoKontrol)
            ->firstOrFail();

        $pemakaian->delete();
        return redirect()->route('pemakaian.index')->with('success', 'Data berhasil dihapus.');
    }
    public function searchNoKontrol(Request $request)
    {
        $search = $request->query('q');
        
        $results = \App\Models\Pemakaian::where('NoKontrol', 'like', '%' . $search . '%')
            ->groupBy('NoKontrol')
            ->limit(12)
            ->pluck('NoKontrol');

        return response()->json($results);
    }
}