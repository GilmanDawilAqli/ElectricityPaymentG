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
        // Ambil hanya yang “Belum Lunas” lalu paginate 10 data per halaman
        $pemakaian = Pemakaian::where('status', 'Belum Lunas')
                     ->with('pelanggan')
                     ->orderByDesc('created_at')   // opsional: urutkan terbaru dulu
                     ->paginate(10);               // ganti 10 sesuai kebutuhan
    
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

        // Cek apakah masih ada pemakaian sebelumnya yang belum lunas untuk pelanggan yang sama
        $cekBelumLunas = Pemakaian::where('NoKontrol', $pemakaian->NoKontrol)
            ->where('status', 'Belum Lunas')
            ->where(function ($query) use ($pemakaian) {
                $query->where('Tahun', '<', $pemakaian->Tahun)
                    ->orWhere(function ($query) use ($pemakaian) {
                        $query->where('Tahun', $pemakaian->Tahun)
                                ->where('Bulan', '<', $pemakaian->Bulan);
                    });
            })
            ->exists();

        if ($cekBelumLunas) {
            return redirect()->back()->with('error', 'Masih ada tagihan sebelumnya yang belum lunas. Harap bayar tagihan terlama terlebih dahulu.');
        }

        // Validasi input
        $request->validate([
            'JumlahBayar' => 'required|numeric|min:' . $pemakaian->JumlahPakai,
            'MetodePembayaran' => 'required|in:tunai,bank',
        ]);

        // Hitung kembalian
        $kembalian = $request->JumlahBayar - $pemakaian->JumlahPakai;

        // Ambil data petugas yang sedang login
        $petugas = auth()->user();

        // Simpan data pembayaran ke tabel pembayaran
        $pembayaran = new Pembayaran();
        $pembayaran->pemakaian_id = $pemakaian->id;
        $pembayaran->petugas_id = $petugas->id;
        $pembayaran->PetugasNama = $petugas->name;
        $pembayaran->MetodePembayaran = $request->MetodePembayaran;
        $pembayaran->JumlahTagihan = $pemakaian->JumlahPakai;
        $pembayaran->JumlahBayar = $request->JumlahBayar;
        $pembayaran->kembalian = $kembalian;
        $pembayaran->save();

        // Update status pemakaian menjadi "Lunas"
        $pemakaian->status = 'Lunas';
        $pemakaian->save();

        return redirect()->route('pembayaran.index', $pemakaian->NoKontrol)
            ->with('success', 'Pembayaran berhasil diproses.');
    }
}
