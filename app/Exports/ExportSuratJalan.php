<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class ExportSuratJalan implements FromView
{
    protected $suratJalan;
    protected $suratJalanProducts;

    public function __construct($suratJalan, $suratJalanProducts)
    {
        $this->suratJalan = $suratJalan;
        $this->suratJalanProducts = $suratJalanProducts;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.export.surat-jalan-excel', [
            'suratJalan' => $this->suratJalan,
            'suratJalanProducts' => $this->suratJalanProducts,
        ]);
    }
}
