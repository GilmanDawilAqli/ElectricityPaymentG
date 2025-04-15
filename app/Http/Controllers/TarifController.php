<?php

namespace App\Http\Controllers;

use App\Models\tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarif = tarif::all();
        return view('tarif', compact('tarif'));
    }

    public function create()
    {
        $tarif = new tarif();
        return view('CRUD.tarif.cu-tarif', compact('tarif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'JenisPelanggan' => 'required|string|max:255|unique:tarif,JenisPelanggan',
            'BiayaBeban' => 'required|numeric',
            'TarifKWH' => 'required|numeric',
        ]);

        tarif::create($request->all());
        return redirect()->route('tarif.index')->with('success', 'Tarif created successfully.');
    }

    public function edit(tarif $tarif)
    {
        return view('CRUD.tarif.cu-tarif', compact('tarif'));
    }

    public function update(Request $request, tarif $tarif)
    {
        $request->validate([
            'JenisPelanggan' => 'required|string|max:255|unique:tarif,JenisPelanggan,' . $tarif->JenisPelanggan . ',JenisPelanggan',
            'BiayaBeban' => 'required|numeric',
            'TarifKWH' => 'required|numeric',
        ]);

        $tarif->update($request->all());
        return redirect()->route('tarif.index')->with('success', 'Tarif updated successfully.');
    }

    public function destroy(tarif $tarif)
    {
        $tarif->delete();
        return redirect()->route('tarif.index')->with('success', 'Tarif deleted successfully.');
    }
}
