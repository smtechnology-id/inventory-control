<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'alamat',
        'nomor_telepon',
    ];

    public function report()
    {
        return $this->hasMany(Report::class, 'konsumen_id');
    }
}
