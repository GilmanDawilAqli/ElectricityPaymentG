<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PemakaianController extends Controller
{
    public function index()
    {
        $pemakaian = Pemakaian::with('pelanggan')->get(); // Pastikan relasi pelanggan dimuat
        return view('pemakaian', compact('pemakaian'));
    }

    public function create()
    {
        return view('CRUD.pemakaian.cu-pemakaian');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Tahun' => 'required|integer',
            'Bulan' => 'required|integer|min:1|max:12',
            'NoKontrol' => 'required|string|exists:pelanggan,NoKontrol',
            'MeterAwal' => 'required|integer',
            'MeterAkhir' => 'required|integer|gte:MeterAwal',
            'BiayaBebanPemakai' => 'required|numeric',
            'BiayaPemakaian' => 'required|numeric',
        ]);

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
        ]);
        return redirect()->route('pemakaian.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($NoKontrol)
    {
        $pemakaian = Pemakaian::where('NoKontrol', $NoKontrol)->firstOrFail();
    
        return view('CRUD.pemakaian.cu-pemakaian', compact('pemakaian'));
    }
    public function update(Request $request, $NoKontrol)
    {
        $request->validate([
            'MeterAwal' => 'required|integer',
            'MeterAkhir' => 'required|integer|gte:MeterAwal',
            'BiayaBebanPemakai' => 'required|numeric',
            'BiayaPemakaian' => 'required|numeric',
        ]);
    
        $pemakaian = Pemakaian::where('NoKontrol', $NoKontrol)->firstOrFail();
    
        $pemakaian->update($request->only([
            'MeterAwal',
            'MeterAkhir',
            'BiayaBebanPemakai',
            'BiayaPemakaian',
        ]));
        return redirect()->route('pemakaian.index')->with('success', 'Data berhasil diperbarui.');
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

    public function getPelanggan(Request $request)
    {
        $term = $request->input('term');
        $pelanggan = Pelanggan::where('NoKontrol', 'like', "%{$term}%")->get(['NoKontrol']);
        return response()->json($pelanggan);
    
    }
    public function getDetailPelanggan($NoKontrol)
    {
        $pelanggan = Pelanggan::where('NoKontrol', $NoKontrol)->firstOrFail();
        $tarif = \App\Models\Tarif::where('JenisPelanggan', $pelanggan->JenisPelanggan)->first();

        return response()->json([
            'Nama' => $pelanggan->Nama,
            'BiayaBeban' => $tarif->BiayaBeban ?? 0, // Jika tidak ada data di tabel Tarif, default ke 0
        ]);
    }
}