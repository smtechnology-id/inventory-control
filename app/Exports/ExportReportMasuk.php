<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class ExportReportMasuk implements FromView
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
        return view('admin.export.report-masuk-excel', [
            'reports' => $this->getViewData(),
            'from' => $this->from,
            'to' => $this->to,
        ]);
    }

    public function getViewData()
    {
        return Report::whereBetween('created_at', [$this->from, $this->to])
            ->get();
    }
}
