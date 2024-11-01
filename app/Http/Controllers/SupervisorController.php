<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;

use App\Models\Driver;
use App\Models\Gudang;
use App\Models\Report;
use App\Models\Product;
use App\Models\Category;
use App\Models\Konsumen;
use App\Models\Supplier;
use App\Models\SuratJalan;
use App\Models\StockOpname;
use Illuminate\Http\Request;
use App\Models\TransferStock;
use App\Exports\ExportSuratJalan;
use App\Models\SuratJalanProduct;
use Maatwebsite\Excel\Facades\Excel;

class SupervisorController extends Controller
{
    public function index()
    {
        $totalBarang = Product::count();
        $gudang = Gudang::count();
        $product = Product::all();
        $user = User::count();
        // Priduct Kritis
        $productKritis = Product::whereColumn('stock', '<=', 'stock_minimal')->get(); // Corrected comparison
        return view('supervisor.dashboard', compact('totalBarang', 'gudang', 'productKritis', 'user'));
    }

    // Product
    public function product()
    {
        $products = Product::all();
        return view('supervisor.product', compact('products'));
    }

    // Category
    public function category()
    {
        $categories = Category::all();
        return view('supervisor.category', compact('categories'));
    }

    // Unit
    public function unit()
    {
        $units = Unit::all();
        return view('supervisor.unit', compact('units'));
    }

    // Stock
    public function stock()
    {
        $products = Product::all();
        $gudangs = Gudang::all();

        return view('supervisor.stock', compact('products', 'gudangs'));
    }


    // Gudang
    public function gudang()
    {
        $gudangs = Gudang::all();
        return view('supervisor.gudang', compact('gudangs'));
    }

    // Driver
    public function driver()
    {
        $drivers = Driver::all();
        return view('supervisor.driver', compact('drivers'));
    }

    // Supplier
    public function supplier()
    {
        $suppliers = Supplier::all();
        return view('supervisor.supplier', compact('suppliers'));
    }

    // Konsumen
    public function konsumen()
    {
        $konsumens = Konsumen::all();
        return view('supervisor.konsumen', compact('konsumens'));
    }

    // History Report
    public function reportMasuk()
    {
        $reports = Report::where('jenis', 'masuk')->latest()->get();
        return view('supervisor.report-history-masuk', compact('reports'));
    }
    public function reportHistoryMasukFilter(Request $request)
    {
        $reports = Report::where('jenis', 'masuk')
            ->whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $from = $request->from;
        $to = $request->to;

        return view('supervisor.report-history-masuk-filter', compact('reports', 'from', 'to'));
    }

    
    public function reportKeluar()
    {
        $reports = SuratJalanProduct::latest()->get();
        return view('supervisor.report-history-product-keluar', compact('reports'));
    }
    public function reportHistoryProductKeluarFilter(Request $request)
    {
        $reports = SuratJalanProduct::whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $from = $request->from;
        $to = $request->to;

        return view('supervisor.report-history-product-keluar-filter', compact('reports', 'from', 'to'));
    }

    public function reportSuratJalan()
    {
        $reports = SuratJalan::latest()->get();
        return view('supervisor.report-history-keluar', compact('reports'));
    }

    public function stockOpname()
    {
        $stockOpnames = StockOpname::latest()->get();

        return view('admin.stock-opname', compact('stockOpnames'));
    }

    
    public function transferStock()
    {
        $transfers = TransferStock::all();
        return view('admin.transfer-stock', compact('transfers'));
    }
    public function addProductSuratJalan($code)
    {
        $suratJalan = SuratJalan::where('kode', $code)->first();
        $products = Product::all();
        $gudangs = Gudang::all();
        $productSuratJalans = SuratJalanProduct::where('surat_jalan_id', $suratJalan->id)->get();
        return view('supervisor.add-product-surat-jalan', compact('suratJalan', 'productSuratJalans', 'products', 'gudangs'));
    }
    public function cetakSuratJalanExcel($code)
    {
        $suratJalan = SuratJalan::where('kode', $code)->first();
        $suratJalanProducts = SuratJalanProduct::where('surat_jalan_id', $suratJalan->id)->get();
        // return view('admin.export.surat-jalan-excel', compact('suratJalan', 'suratJalanProducts'));
        return Excel::download(new ExportSuratJalan($suratJalan, $suratJalanProducts), 'surat-jalan-' . $suratJalan->kode . '.xlsx');
    }

        // Account Supervisor
        public function accountSupervisor()
        {
            $accounts = User::where('level', 'supervisor')->get();
            return view('supervisor.account-supervisor', compact('accounts'));
        }
    
        // Account Staff
        public function accountStaff()
        {
            $accounts = User::where('level', 'staff')->get();
            return view('supervisor.account-staff', compact('accounts'));
        }
    

}
