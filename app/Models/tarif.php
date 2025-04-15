<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tarif extends Model
{
    use HasFactory;
    protected $table = 'tarif';
    protected $primaryKey = 'JenisPelanggan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'JenisPelanggan',
        'BiayaBeban',
        'TarifKWH',
    ];
}
