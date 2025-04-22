<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Models\Pelanggan;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('pemakaian')->get(); // Pastikan relasi pemakaian dimuat
        return view('pembayaran', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function searchPelanggan(Request $request)
    {
        $query = $request->get('q');
        $pelanggan = Pelanggan::where('NoKontrol', 'LIKE', '%' . $query . '%')
            ->select('NoKontrol', 'NamaPelanggan', 'Alamat', 'TarifDaya') // Sesuaikan dengan kolom tabel pelanggan
            ->get();

        return response()->json($pelanggan);
    }

    public function showPemakaianBelumLunas($NoKontrol)
    {
        $pelanggan = Pelanggan::where('NoKontrol', $NoKontrol)->firstOrFail();
        $pemakaian = Pemakaian::where('NoKontrol', $NoKontrol)
            ->where('status', 'Belum Lunas') // Hanya pemakaian dengan status "Belum Lunas"
            ->get();
    
        return view('pembayaran.daftar_pemakaian', [
            'pelanggan' => $pelanggan,
            'pemakaian' => $pemakaian,
        ]);
    }

    public function showFormBayar($id)
{
    $pemakaian = Pemakaian::findOrFail($id);
    $pelanggan = Pelanggan::where('NoKontrol', $pemakaian->NoKontrol)->firstOrFail();
    $petugas = auth()->user(); // Ambil data petugas yang sedang login

    return view('CRUD.pembayaran.bayar', [
        'pemakaian' => $pemakaian,
        'pelanggan' => $pelanggan,
        'petugas' => $petugas,
    ]);
}

    /**
     * Proses pembayaran.
     */
    public function processBayar(Request $request, $id)
    {
        $pemakaian = Pemakaian::findOrFail($id);
    
        $request->validate([
            'JumlahBayar' => 'required|numeric|min:0',
            'MetodePembayaran' => 'required|in:tunai,bank',
        ]);
    
        $kembalian = $request->JumlahBayar - $pemakaian->JumlahTagihan;
    
        $pembayaran = new Pembayaran();
        $pembayaran->pemakaian_id = $pemakaian->id;
        $pembayaran->petugas_id = auth()->id(); // Ambil ID petugas yang sedang login
        $pembayaran->NoKontrol = $pemakaian->NoKontrol;
        $pembayaran->MetodePembayaran = $request->MetodePembayaran;
        $pembayaran->JumlahTagihan = $pemakaian->JumlahTagihan;
        $pembayaran->JumlahBayar = $request->JumlahBayar;
        $pembayaran->kembalian = $kembalian;
        $pembayaran->save();
    
        // Update status pemakaian menjadi "Lunas"
        $pemakaian->status = 'Lunas';
        $pemakaian->save();
    
        return redirect()->route('pembayaran.daftar_pemakaian', $pemakaian->NoKontrol)->with('success', 'Pembayaran berhasil diproses.');
    }
}
