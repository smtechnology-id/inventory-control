<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'nomor_po',
        'keterangan',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
