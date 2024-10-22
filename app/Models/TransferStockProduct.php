<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferStockProduct extends Model
{
    use HasFactory;

    protected $table = 'transfer_stock_product';

    protected $fillable = [
        'transfer_stock_id',
        'product_gudang_awal_id',
        'product_gudang_tujuan_id',
        'qty',
        'keterangan',
    ];

    public function transferStock()
    {
        return $this->belongsTo(TransferStock::class, 'transfer_stock_id');
    }

    public function productGudangAwal()
    {
        return $this->belongsTo(Product::class, 'product_gudang_awal_id');
    }

    public function productGudangTujuan()
    {
        return $this->belongsTo(Product::class, 'product_gudang_tujuan_id');
    }
}
