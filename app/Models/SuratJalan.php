<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;
    protected $table = 'surat_jalan';
    protected $fillable = [
        'kode',
        'nomor_do',
        'driver_id',
        'konsumen_id',
        'via',
        'carrier',
        'reff',
        'truck_number',
        'delivered_by',
        'attn',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class);
    }
}
