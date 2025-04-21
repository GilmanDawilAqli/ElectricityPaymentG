<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'NoKontrol';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'NoKontrol',
        'Nama',
        'Alamat',
        'Telepon',
        'JenisPelanggan',
    ];
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'JenisPelanggan', 'JenisPelanggan');
    }
}