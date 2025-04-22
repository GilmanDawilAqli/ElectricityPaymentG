<x-layout></x-layout>

<div class="container">
    <h2>Form Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pembayaran.proses_bayar', $pemakaian->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>ID Petugas</label>
            <input type="text" class="form-control" value="{{ $petugas->id }}" disabled>
        </div>

        <div class="mb-3">
            <label>Nama Petugas</label>
            <input type="text" class="form-control" value="{{ $petugas->name }}" disabled>
        </div>

        <div class="mb-3">
            <label>No Kontrol</label>
            <input type="text" class="form-control" value="{{ $pelanggan->NoKontrol }}" disabled>
        </div>

        <div class="mb-3">
            <label>Nama Pelanggan</label>
            <input type="text" class="form-control" value="{{ $pelanggan->NamaPelanggan }}" disabled>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" class="form-control" value="{{ $pelanggan->Alamat }}" disabled>
        </div>

        <div class="mb-3">
            <label>Bulan/Tahun</label>
            <input type="text" class="form-control" value="{{ $pemakaian->BulanTagihan }} - {{ $pemakaian->TahunTagihan }}" disabled>
        </div>

        <div class="mb-3">
            <label>Meter Awal</label>
            <input type="text" class="form-control" value="{{ $pemakaian->MeterAwal }}" disabled>
        </div>

        <div class="mb-3">
            <label>Meter Akhir</label>
            <input type="text" class="form-control" value="{{ $pemakaian->MeterAkhir }}" disabled>
        </div>

        <div class="mb-3">
            <label>Biaya Beban</label>
            <input type="text" class="form-control" value="{{ $pemakaian->BiayaBeban }}" disabled>
        </div>

        <div class="mb-3">
            <label>Total Pemakaian</label>
            <input type="text" class="form-control" value="{{ $pemakaian->MeterAkhir - $pemakaian->MeterAwal }}" disabled>
        </div>

        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="MetodePembayaran" class="form-control">
                <option value="tunai">Tunai</option>
                <option value="bank">Bank</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah Tagihan</label>
            <input type="text" class="form-control" value="{{ $pemakaian->JumlahTagihan }}" disabled>
        </div>

        <div class="mb-3">
            <label>Jumlah Bayar</label>
            <input type="number" name="JumlahBayar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kembalian</label>
            <input type="text" class="form-control" value="0" disabled>
        </div>

        <button type="submit" class="btn btn-primary">Proses</button>
    </form>
</div>