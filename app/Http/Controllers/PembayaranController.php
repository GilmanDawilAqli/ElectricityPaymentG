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
        $pemakaian = Pemakaian::where('status', 'Belum Lunas')->with('pelanggan')->get();
        return view('pembayaran', compact('pemakaian'));
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
    public function showFormBayar($id)
    {
        // Ambil data pemakaian berdasarkan ID
        $pemakaian = Pemakaian::with('pelanggan')->findOrFail($id);
    
        // Ambil data petugas yang sedang login
        $petugas = auth()->user();
    
        // Kirim data ke view
        return view('CRUD.pembayaran.bayar', compact('pemakaian', 'petugas'));
    }


    public function searchPelanggan(Request $request)
    {
        $query = $request->get('q');
        $pelanggan = Pelanggan::where('NoKontrol', 'LIKE', '%' . $query . '%')
            ->select('NoKontrol', 'NamaPelanggan', 'Alamat', 'TarifDaya') // Sesuaikan dengan kolom tabel pelanggan
            ->get();

        return response()->json($pelanggan);
    }

    /**
     * Proses pembayaran.
     */
    public function processBayar(Request $request, $id)
    {
        // Ambil data pemakaian berdasarkan ID
        $pemakaian = Pemakaian::findOrFail($id);

        // Validasi input
        $request->validate([
            'JumlahBayar' => 'required|numeric|min:' . $pemakaian->JumlahPakai, // Tidak boleh kurang dari JumlahTagihan
            'MetodePembayaran' => 'required|in:tunai,bank', // Pilihan hanya "tunai" atau "bank"
        ]);

        // Hitung kembalian
        $kembalian = $request->JumlahBayar - $pemakaian->JumlahPakai;

        // Ambil data petugas yang sedang login
        $petugas = auth()->user();

        // Simpan data pembayaran ke tabel pembayaran
        $pembayaran = new Pembayaran();
        $pembayaran->pemakaian_id = $pemakaian->id; // ID dari tabel Pemakaian
        $pembayaran->petugas_id = $petugas->id; // ID petugas yang sedang login
        $pembayaran->PetugasNama = $petugas->name; // Nama petugas yang sedang login
        $pembayaran->MetodePembayaran = $request->MetodePembayaran; // Metode pembayaran
        $pembayaran->JumlahTagihan = $pemakaian->JumlahPakai; // Jumlah tagihan dari tabel Pemakaian
        $pembayaran->JumlahBayar = $request->JumlahBayar; // Jumlah yang dibayarkan
        $pembayaran->kembalian = $kembalian; // Kembalian
        $pembayaran->save();

        // Update status pemakaian menjadi "Lunas"
        $pemakaian->status = 'Lunas';
        $pemakaian->save();

        // Redirect kembali ke daftar pemakaian dengan pesan sukses
        return redirect()->route('pembayaran.index', $pemakaian->NoKontrol)
            ->with('success', 'Pembayaran berhasil diproses.');
    }
}
