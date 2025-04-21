<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $table = 'pemakaian';
    protected $primaryKey = ['Tahun', 'Bulan', 'NoKontrol'];
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
}