<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'gudang_awal',
        'gudang_tujuan',
        'nomor_do',
        'attendant',
        'via',
        'carrier',
        'keterangan',
        'refrensi',
        'lokasi_kirim',
        'truck_number',
        'delivered_by',
    ];

    public function gudangAwal()
    {
        return $this->belongsTo(Gudang::class, 'gudang_awal');
    }

    public function gudangTujuan()
    {
        return $this->belongsTo(Gudang::class, 'gudang_tujuan');
    }
}
