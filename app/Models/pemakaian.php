<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $table = 'pemakaian';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'Tahun',
        'Bulan',
        'NoKontrol',
        'JumlahPakai',
        'MeterAwal',
        'MeterAkhir',
        'BiayaBebanPemakai',
        'BiayaPemakaian',
        'Status',
    ];
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'NoKontrol', 'NoKontrol');
    }
    public function getNamaBulanAttribute()
    {
        $bulanList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return $bulanList[$this->Bulan] ?? $this->Bulan;
    }
}