<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan', compact('pelanggan'));
    }

    public function create()
    {
        $tarif = Tarif::all();

        // Ambil tanggal hari ini dalam format YYMMDD
        $prefix = now()->format('ym'); // contoh: '250422'
    
        // Cari jumlah pelanggan hari ini dengan prefix yang sama
        $countToday = Pelanggan::where('NoKontrol', 'like', "$prefix%")->count();
    
        // Nomor urut 6 digit, mulai dari 000001
        $number = str_pad($countToday + 1, 8, '0', STR_PAD_LEFT);
    
        $generatedNoKontrol = $prefix . $number;
    
        return view('CRUD.pelanggan.cu-pelanggan', compact('tarif', 'generatedNoKontrol'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            
            'NoKontrol' => 'required|string|min:12|max:12|unique:pelanggan,NoKontrol',
            'Nama' => 'required|string|max:50',
            'Alamat' => 'required|string|max:150',
            'Telepon' => 'required|string|max:15|regex:/^\+?[0-9]+$/',
            'JenisPelanggan' => 'required|string|exists:tarif,JenisPelanggan',
        ]);

        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function edit($NoKontrol)
    {
        $pelanggan = Pelanggan::findOrFail($NoKontrol);
        $tarif = Tarif::all();
        return view('CRUD.pelanggan.cu-pelanggan', compact('pelanggan', 'tarif'));
    }

    public function update(Request $request, $NoKontrol)
    {
        $request->validate([
            'Nama' => 'required|string|max:50',
            'Alamat' => 'required|string|max:150',
            'Telepon' => 'required|string|max:15|regex:/^\+?[0-9]+$/',
            'JenisPelanggan' => 'required|string|exists:tarif,JenisPelanggan',
        ]);

        $pelanggan = Pelanggan::findOrFail($NoKontrol);
        $pelanggan->update($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy($NoKontrol)
    {
        $pelanggan = Pelanggan::findOrFail($NoKontrol);
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
    
}