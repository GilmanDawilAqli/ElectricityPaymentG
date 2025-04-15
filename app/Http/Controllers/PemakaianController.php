<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    public function index()
    {
        $pemakaian = Pemakaian::with('pelanggan')->get();
        return view('CRUD.pemakaian.index', compact('pemakaian'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all(); // Ambil data pelanggan untuk dropdown
        return view('CRUD.pemakaian.cu-pemakaian', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Tahun' => 'required|integer',
            'Bulan' => 'required|integer|min:1|max:12',
            'NoKontrol' => 'required|exists:pelanggan,NoKontrol',
            'MeterAwal' => 'required|integer|min:0',
            'MeterAkhir' => 'required|integer|min:0|gte:MeterAwal',
            'BiayaBebanPemakai' => 'required|numeric',
            'BiayaPemakaian' => 'required|numeric',
        ]);

        Pemakaian::create($request->all());
        return redirect()->route('pemakaian.index')->with('success', 'Pemakaian created successfully.');
    }

    public function edit(Pemakaian $pemakaian)
    {
        $pelanggan = Pelanggan::all(); // Ambil data pelanggan untuk dropdown
        return view('CRUD.pemakaian.cu-pemakaian', compact('pemakaian', 'pelanggan'));
    }

    public function update(Request $request, Pemakaian $pemakaian)
    {
        $request->validate([
            'Tahun' => 'required|integer',
            'Bulan' => 'required|integer|min:1|max:12',
            'NoKontrol' => 'required|exists:pelanggan,NoKontrol',
            'MeterAwal' => 'required|integer|min:0',
            'MeterAkhir' => 'required|integer|min:0|gte:MeterAwal',
            'BiayaBebanPemakai' => 'required|numeric',
            'BiayaPemakaian' => 'required|numeric',
        ]);

        $pemakaian->update($request->all());
        return redirect()->route('pemakaian.index')->with('success', 'Pemakaian updated successfully.');
    }

    public function destroy(Pemakaian $pemakaian)
    {
        $pemakaian->delete();
        return redirect()->route('pemakaian.index')->with('success', 'Pemakaian deleted successfully.');
    }
}