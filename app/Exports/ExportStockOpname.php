<?php

namespace App\Exports;

use App\Models\TransferStock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\StockOpname;

class ExportStockOpname implements FromView
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
        return view('admin.export.stock-opname-excel', [
            'stockOpnames' => $this->getViewData(),
            'from' => $this->from,
            'to' => $this->to,
        ]);
    }

    public function getViewData()
    {
        return StockOpname::whereBetween('created_at', [$this->from, $this->to])
            ->get();
    }
}
