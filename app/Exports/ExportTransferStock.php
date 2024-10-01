<?php

namespace App\Exports;

use App\Models\TransferStock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportTransferStock implements FromView
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
        return view('admin.export.transfer-stock-excel', [
            'transfers' => $this->getViewData(),
            'from' => $this->from,
            'to' => $this->to,
        ]);
    }

    public function getViewData()
    {
        return TransferStock::whereBetween('created_at', [$this->from, $this->to])
            ->get();
    }
}
