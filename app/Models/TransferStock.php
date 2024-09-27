<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'gudang_awal',
        'gudang_tujuan',
        'quantity',
        'keterangan',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function gudangTujuan()
    {
        return $this->belongsTo(Gudang::class, 'gudang_tujuan');
    }

    public function gudangAwal()
    {
        return $this->belongsTo(Gudang::class, 'gudang_awal');
    }
}
