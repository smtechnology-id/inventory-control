<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    protected $table = 'stock_opnames';
    protected $fillable = [
        'stock_id',
        'stock_tercatat',
        'jumlah_aktual',
        'keterangan',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    
}