<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    protected $fillable = ['gudang_id', 'product_id', 'stock'];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
