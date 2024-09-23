<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'driver_id',
        'supplier_id',
        'konsumen_id',
        'gudang_id',
        'nomor_po',
        'nomor_do',
        'keterangan',
        'jenis',
        'quantity',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}
