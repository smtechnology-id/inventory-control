<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stock;
use App\Models\Driver;
use App\Models\Gudang;
use App\Models\Product;
use App\Models\Konsumen;
use App\Models\Supplier;
use App\Models\SuratJalan;
use Illuminate\Http\Request;
use App\Models\SuratJalanProduct;

class StaffController extends Controller
{
    public function index()
    {
        $totalBarang = Product::count();
        $gudang = Gudang::count();
        $supplier = Supplier::count();
        $konsumen = Konsumen::count();
        $driver = Driver::count();
        $user = User::count();

        // Stock Kritis
        $stock = Stock::all();
        $stockKritis = []; // Inisialisasi array untuk menyimpan stok kritis
        foreach ($stock as $s) {
            $product_id = $s->product_id;
            $product = Product::find($product_id);
            $stockMinimal = $product->stock_minimal;

            $stockKritisFlag = $s->stock <= $stockMinimal; // Menggunakan nama variabel yang lebih jelas
            if ($stockKritisFlag) {
                $stockKritis[] = $s; // Menambahkan stok ke array jika kritis
            }
        }
        return view('staff.dashboard', compact('totalBarang', 'gudang', 'supplier', 'konsumen', 'driver', 'user', 'stockKritis'));
    }

    public function addReportKeluar()
    {
        $stocks = Stock::all();
        $drivers = Driver::all();
        $konsumens = Konsumen::all();
        $gudangs = Gudang::all();
        $products = Product::all();
        return view('staff.add-report-keluar', compact('stocks', 'drivers', 'konsumens', 'gudangs', 'products'));
    }

    public function storeReportKeluar(Request $request)
    {
        $request->validate([
            'driver_id' => 'required',
            'nomor_do' => 'required',
            'konsumen_id' => 'required',
            'via' => 'required',
            'carrier' => 'required',
            'reff' => 'required',
            'truck_number' => 'required',
            'delivered_by' => 'required',
        ]);
        $suratJalan = new SuratJalan();
        $suratJalan->driver_id = $request->driver_id;
        $suratJalan->konsumen_id = $request->konsumen_id;
        $suratJalan->nomor_do = $request->nomor_do;
        $suratJalan->via = $request->via;
        $suratJalan->carrier = $request->carrier;
        $suratJalan->reff = $request->reff;
        $suratJalan->truck_number = $request->truck_number;
        $suratJalan->delivered_by = $request->delivered_by;
        $code = 'SJ-' . date('YmdHis');
        $suratJalan->kode = $code;
        $suratJalan->save();
        return redirect()->route('staff.add.product.surat.jalan', $suratJalan->kode)->with('success', 'Report keluar added successfully');
    }
    public function addProductSuratJalan($code)
    {
        $suratJalan = SuratJalan::where('kode', $code)->first();
        $products = Product::all();
        $gudangs = Gudang::all();
        $productSuratJalans = SuratJalanProduct::where('surat_jalan_id', $suratJalan->id)->get();
        return view('staff.add-product-surat-jalan', compact('suratJalan', 'productSuratJalans', 'products', 'gudangs'));
    }

    public function storeProductSuratJalan(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'gudang_id' => 'required',
            'qty' => 'required',
            'keterangan' => 'nullable',
        ]);
        $stock = Stock::where('product_id', $request->product_id)
            ->where('gudang_id', $request->gudang_id)
            ->first();
        if (!$stock) {
            return redirect()->back()->with('error', 'Stock product tidak ada');
        } else {
            if ($stock->stock < $request->qty) {
                return redirect()->back()->with('error', 'Stock product tidak cukup');
            }

            // Update Stock
            $stock->stock -= $request->qty;
            $stock->save();

            $suratJalanProduct = new SuratJalanProduct();
            $suratJalanProduct->surat_jalan_id = $request->surat_jalan_id;
            $suratJalanProduct->stock_id = $stock->id;
            $suratJalanProduct->qty = $request->qty;
            $suratJalanProduct->keterangan = $request->keterangan;
            $suratJalanProduct->save();
        }

        return redirect()->back()->with('success', 'Product surat jalan added successfully');
    }

}
