<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    
    public function search(Request $request)
    {
        $NoKontrol = $request->input('search');
    
        $pemakaian = Pemakaian::where('NoKontrol', $NoKontrol)->get();
        $pelanggan = Pelanggan::find($NoKontrol);
    
        if ($pemakaian->isEmpty()) {
            return view('welcome', ['message' => 'Data tidak ditemukan']);
        }
    
        return view('welcome', compact('pemakaian', 'pelanggan'));
    }
}
