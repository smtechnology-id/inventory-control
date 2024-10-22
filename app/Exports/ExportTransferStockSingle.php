<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportTransferStockSingle implements FromView
{
    protected $transfer;

    public function __construct($transfer)
    {
        $this->transfer = $transfer;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.export.transfer-stock-single-excel', [
            'transfer' => $this->transfer,
        ]);
    }
}
