<?php

namespace App\Exports;

use App\Models\Report;
use App\Models\SuratJalanProduct;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportReportBarangKeluar implements FromView
{
    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.export.report-history-product-keluar-excel', [
            'reports' => $this->getViewData(),
            'from' => $this->from,
            'to' => $this->to,
        ]);
    }

    public function getViewData()
    {
        return SuratJalanProduct::whereBetween('created_at', [$this->from, $this->to])
            ->get();
    }
}
