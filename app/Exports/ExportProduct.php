<?php

namespace App\Exports;

use App\Models\Gudang;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportProduct implements FromView
{
    protected $gudang_id;

    public function __construct($gudang_id)
    {
        $this->gudang_id = $gudang_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $gudang = Gudang::where('id', $this->gudang_id)->first();
        return view('admin.export.product-filter-excel', [
            'products' => $this->getViewData(),
            'gudang' => $gudang,
        ]);
    }

    public function getViewData()
    {
        return Product::where('gudang_id', $this->gudang_id)
            ->get();
    }
}
