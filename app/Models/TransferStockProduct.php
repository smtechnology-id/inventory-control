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

    // Definisikan relasi dengan model TransferStock
    public function transferStock()
    {
        return $this->belongsTo(TransferStock::class);
    }

    // Definisikan relasi dengan model Product untuk gudang awal
    public function productGudangAwal()
    {
        return $this->belongsTo(Product::class, 'product_gudang_awal_id');
    }

    // Definisikan relasi dengan model Product untuk gudang tujuan
    public function productGudangTujuan()
    {
        return $this->belongsTo(Product::class, 'product_gudang_tujuan_id');
    }
}