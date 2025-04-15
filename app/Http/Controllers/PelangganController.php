<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelangganRequest;
use App\Models\pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = pelanggan::all();
        return view('pelanggan.pelanggan', compact('pelanggan'));
    }

    public function create()
    {
        // Mengirimkan instance kosong untuk create
        $pelanggan = new pelanggan();
        return view('pelanggan.cu-pelanggan', compact('pelanggan'));
    }

    public function store(PelangganRequest $request)
    {
        pelanggan::create($request->validated());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan created successfully.');
    }

    public function edit(pelanggan $pelanggan)
    {
        // Mengirimkan data pelanggan untuk edit
        return view('pelanggan.cu-pelanggan', compact('pelanggan'));
    }

    public function update(PelangganRequest $request, pelanggan $pelanggan)
    {
        $pelanggan->update($request->validated());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan updated successfully.');
    }

    public function destroy(pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan deleted successfully.');
    }
}