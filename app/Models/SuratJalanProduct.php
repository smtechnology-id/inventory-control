<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalanProduct extends Model
{
    use HasFactory;
    protected $table = 'surat_keluar_product';
    protected $fillable = [
        'surat_jalan_id',
        'stock_id',
        'qty',
        'keterangan',
    ];
    public function suratJalan()
    {
        return $this->belongsTo(SuratJalan::class, 'surat_jalan_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
