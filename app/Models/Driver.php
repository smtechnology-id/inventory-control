<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'drivers';
    protected $fillable = [
        'nama_driver',
        'nomor_hp_driver',
        'nomor_polisi_kendaraan',
        'keterangan',
    ];
}
