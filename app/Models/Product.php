<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'unit_id',
        'nomor_material',
        'kode_barang',
        'nama_barang',
        'slug',
        'stock_awal',
        'stock_minimal',
        'keterangan',
        'harga',
        'stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    // Definisikan relasi dengan model TransferStockProduct untuk gudang awal
    public function transferStockProductsGudangAwal()
    {
        return $this->hasMany(TransferStockProduct::class, 'product_gudang_awal_id');
    }

    // Definisikan relasi dengan model TransferStockProduct untuk gudang tujuan
    public function transferStockProductsGudangTujuan()
    {
        return $this->hasMany(TransferStockProduct::class, 'product_gudang_tujuan_id');
    }
}
