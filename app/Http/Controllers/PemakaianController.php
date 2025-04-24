<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pelanggan;
use App\Models\Pemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
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
            'JumlahPakai' => 'required|numeric',
        ]);

        $cekDuplikat = Pemakaian::where('NoKontrol', $request->NoKontrol)
        ->where('Tahun', $request->Tahun)
        ->where('Bulan', $request->Bulan)
        ->exists();

        if ($cekDuplikat) {
            return back()->withErrors(['Bulan' => 'Data pemakaian untuk bulan ini sudah ada untuk pelanggan ini.'])->withInput();
        }


        // Ambil data pelanggan dan relasi tarif
        $pelanggan = Pelanggan::with('tarif')->where('NoKontrol', $request->NoKontrol)->first();

        if (!$pelanggan || !$pelanggan->tarif) {
            return back()->withErrors(['NoKontrol' => 'Tarif tidak ditemukan untuk pelanggan ini.'])->withInput();
        }

        // Ambil tarif dan biaya beban dari relasi
        $tarifKwh = $pelanggan->tarif->TarifKWH;
        $biayaBeban = $pelanggan->tarif->BiayaBeban;

        // Hitung biaya pemakaian dan jumlah pakai
        $biayaPemakaian = max($request->MeterAkhir - $request->MeterAwal, 0); // Pastikan tidak negatif
        $jumlahPakai = ($tarifKwh * $biayaPemakaian) + $biayaBeban;

        Pemakaian::create([
            'NoKontrol' => $request->NoKontrol,
            'Tahun' => $request->Tahun,
            'Bulan' => $request->Bulan,
            'MeterAwal' => $request->MeterAwal,
            'MeterAkhir' => $request->MeterAkhir,
            'BiayaBebanPemakai' => $request->BiayaBebanPemakai,
            'BiayaPemakaian' => $request->BiayaPemakaian,
            'JumlahPakai' => $jumlahPakai,
            'Status' => 'Belum Lunas',
        ]);
        return redirect()->route('pemakaian.index')->with('success', 'Data berhasil ditambahkan.');
    }
    
    public function destroy($id)
    {
        $pemakaian = Pemakaian::findOrFail($id);
        $pemakaian->delete();
        return redirect()->route('pemakaian.index')->with('success', 'Data pemakaian berhasil dihapus.');
    }

    public function searchNoKontrol(Request $request)
    {
        $search = $request->query('q');
        
        $results = Pelanggan::where('NoKontrol', 'like', '%' . $search . '%')
            ->limit(12)
            ->pluck('NoKontrol');

        return response()->json($results);
    }
    // Search Pelanggan dengan NoKontrol
    public function getPelanggan(Request $request)
    {
        $data = Pelanggan::where('NoKontrol', 'LIKE', '%' . $request->term . '%')
            ->select('NoKontrol')
            ->get();

        return response()->json($data);
    }
    public function getPelangganInfo($NoKontrol)
    {
        $pelanggan = DB::table('pelanggan')
            ->leftJoin('tarif', 'pelanggan.JenisPelanggan', '=', 'tarif.JenisPelanggan')
            ->where('pelanggan.NoKontrol', $NoKontrol)
            ->select('pelanggan.Nama', 'pelanggan.JenisPelanggan', 'tarif.TarifKWH', 'tarif.BiayaBeban')
            ->first();

        if (!$pelanggan) {
            return response()->json(['error' => 'Pelanggan tidak ditemukan'], 404);
        }

        $lastUsage = DB::table('pemakaian')
            ->where('NoKontrol', $NoKontrol)
            ->orderByDesc('Tahun')
            ->orderByDesc('Bulan')
            ->first();

        return response()->json([
            'nama' => $pelanggan->Nama,
            'biaya_beban' => $pelanggan->BiayaBeban ?? 0,
            'tarifKwh' => $pelanggan->TarifKWH ?? 0,
            'meter_akhir_sebelumnya' => $lastUsage->MeterAkhir ?? 0
        ]);
    }
}