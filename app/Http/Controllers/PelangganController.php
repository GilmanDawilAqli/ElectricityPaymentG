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
        return view('CRUD.pelanggan.cu-pelanggan', compact('tarif'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            
            'NoKontrol' => 'required|string|max:12|unique:pelanggan,NoKontrol',
            'Nama' => 'required|string|max:50',
            'Alamat' => 'required|string|max:150',
            'Telepon' => 'required|string|max:15',
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
            'Telepon' => 'required|string|max:15',
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