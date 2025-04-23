<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use App\Models\pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $status     = $request->get('status');
        $tahun      = $request->get('tahun');
        $bulan      = $request->get('bulan');
        $nokontrol  = $request->get('nokontrol');

        $query = Pemakaian::with('pelanggan');

        if ($status) {
            $query->where('status', $status);
        }

        if ($tahun) {
            $query->where('Tahun', $tahun);
        }

        if ($bulan) {
            $query->where('Bulan', $bulan);
        }

        if ($nokontrol) {
            $query->where('NoKontrol', 'like', "%$nokontrol%");
        }

        $pemakaian = $query->get();

        return view('laporan', compact('pemakaian'));
    }

    public function generate(Request $request)
    {
        $query = Pemakaian::query()->with('pelanggan');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tahun')) {
            $query->where('Tahun', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->where('Bulan', $request->bulan);
        }

        if ($request->filled('nokontrol')) {
            $query->where('NoKontrol', 'like', '%' . $request->nokontrol . '%');
        }

        // Query untuk data lunas
        $lunas = Pemakaian::with(['pelanggan', 'pembayaran'])
        ->where('status', 'Lunas');

         // Query untuk data belum lunas
        $belumLunas = Pemakaian::with('pelanggan')
        ->where('status', 'Belum Lunas');

        $dataLunas = clone $query;
        $dataBelumLunas = clone $query;

        $lunas = $dataLunas->where('Status', 'Lunas')->get();
        $belumLunas = $dataBelumLunas->where('Status', 'Belum Lunas')->get();

        // Generate PDF untuk "Lunas" dengan orientasi landscape dan margin sempit
        $pdf = Pdf::loadView('laporan.pdf', compact('lunas', 'belumLunas'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_pemakaian.pdf');
    }

    public function generateSatu($id)
    {
        $data = Pemakaian::with('pelanggan')->findOrFail($id);

        $pdf = Pdf::loadView('laporan.laporan_satu', compact('data'));

        return $pdf->download("Laporan-{$data->NoKontrol}-{$data->Bulan}-{$data->Tahun}.pdf");
    }
}
