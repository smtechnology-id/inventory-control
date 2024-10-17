<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_awal',
        'product_tujuan',
        'quantity',
        'keterangan',
        'refrensi',
        'lokasi_kirim',
    ];

    public function productAwal()
    {
        return $this->belongsTo(Product::class, 'product_awal');
    }

    public function productTujuan()
    {
        return $this->belongsTo(Product::class, 'product_tujuan');
    }
}
