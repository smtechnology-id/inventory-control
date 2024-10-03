<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Stock;
use App\Models\Driver;
use App\Models\Gudang;
use App\Models\Report;
use App\Models\Product;
use App\Models\Category;
use App\Models\Konsumen;
use App\Models\Supplier;
use App\Models\SuratJalan;
use App\Models\StockOpname;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransferStock;
use App\Exports\ExportSuratJalan;
use App\Models\SuratJalanProduct;
use App\Exports\ExportReportMasuk;
use App\Exports\ExportStockOpname;
use App\Exports\ExportReportKeluar;
use App\Exports\ExportTransferStock;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportReportBarangKeluar;

class AdminController extends Controller
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
        return view('admin.dashboard', compact('totalBarang', 'gudang', 'supplier', 'konsumen', 'driver', 'user', 'stockKritis'));
    }

    // Product
    public function products()
    {
        $products = Product::all();
        return view('admin.product', compact('products'));
    }

    public function addProduct()
    {
        // Cek apakah ada data di table category dan unit   
        if (Category::count() == 0) {
            return redirect()->route('admin.category')->with('error', 'Category tidak ada, silahkan tambahkan category terlebih dahulu');
        }
        if (Unit::count() == 0) {
            return redirect()->route('admin.unit')->with('error', 'Unit tidak ada, silahkan tambahkan unit terlebih dahulu');
        }
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.add-product', compact('categories', 'units'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'unit' => 'required',
            'nomor_material' => 'required',
            'kode_barang' => 'required',
            'name' => 'required',
            'stock_minimal' => 'required',
            'keterangan' => 'nullable',
        ]);

        $product = new Product();
        $product->category_id = $request->category;
        $product->unit_id = $request->unit;
        $product->nomor_material = $request->nomor_material;
        $product->kode_barang = $request->kode_barang;
        $product->nama_barang = $request->name;
        $product->stock_minimal = $request->stock_minimal;
        $product->keterangan = $request->keterangan;
        $product->slug = Str::slug($request->name);
        $product->save();
        return redirect()->route('admin.product')->with('success', 'Product added successfully');
    }

    public function editProduct($slug)
    {
        $categories = Category::all();
        $units = Unit::all();
        $product = Product::where('slug', $slug)->first();
        return view('admin.edit-product', compact('product', 'categories', 'units'));
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'unit' => 'required',
            'nomor_material' => 'required',
            'kode_barang' => 'required',
            'name' => 'required',
            'stock_minimal' => 'required',
            'keterangan' => 'nullable',
        ]);

        $product = Product::where('id', $request->id)->first();
        $product->category_id = $request->category;
        $product->unit_id = $request->unit;
        $product->nomor_material = $request->nomor_material;
        $product->kode_barang = $request->kode_barang;
        $product->nama_barang = $request->name;
        $product->stock_minimal = $request->stock_minimal;
        $product->keterangan = $request->keterangan;
        $product->save();
        return redirect()->route('admin.product')->with('success', 'Product updated successfully');
    }

    public function deleteProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $product->delete();
        return redirect()->route('admin.product')->with('success', 'Product deleted successfully');
    }


    // Category
    public function categories()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->route('admin.category')->with('success', 'Category added successfully');
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->route('admin.category')->with('success', 'Category updated successfully');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.category')->with('success', 'Category deleted successfully');
    }

    // Unit
    public function units()
    {
        $units = Unit::all();
        return view('admin.unit', compact('units'));
    }

    public function storeUnit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->slug = Str::slug($request->name);
        $unit->save();
        return redirect()->route('admin.unit')->with('success', 'Unit added successfully');
    }

    public function updateUnit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $unit = Unit::find($request->id);
        $unit->name = $request->name;
        $unit->save();
        return redirect()->route('admin.unit')->with('success', 'Unit updated successfully');
    }

    public function deleteUnit($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->route('admin.unit')->with('success', 'Unit deleted successfully');
    }

    // Gudang
    public function gudang()
    {
        $gudangs = Gudang::all();
        return view('admin.gudang', compact('gudangs'));
    }

    public function storeGudang(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $gudang = new Gudang();
        $gudang->name = $request->name;
        $gudang->slug = Str::slug($request->name);
        $gudang->save();
        return redirect()->route('admin.gudang')->with('success', 'Gudang added successfully');
    }

    public function updateGudang(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $gudang = Gudang::find($request->id);
        $gudang->name = $request->name;
        $gudang->save();
        return redirect()->route('admin.gudang')->with('success', 'Gudang updated successfully');
    }

    public function deleteGudang($slug)
    {
        $gudang = Gudang::where('slug', $slug)->first();
        $gudang->delete();
        return redirect()->route('admin.gudang')->with('success', 'Gudang deleted successfully');
    }


    // Driver
    public function driver()
    {
        $drivers = Driver::all();
        return view('admin.driver', compact('drivers'));
    }

    public function storeDriver(Request $request)
    {
        $request->validate([
            'nama_driver' => 'required|string|max:255',
            'nomor_hp_driver' => 'required|string|max:255',
            'nomor_polisi_kendaraan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);
        $driver = new Driver();
        $driver->nama_driver = $request->nama_driver;
        $driver->nomor_hp_driver = $request->nomor_hp_driver;
        $driver->nomor_polisi_kendaraan = $request->nomor_polisi_kendaraan;
        $driver->keterangan = $request->keterangan;
        $driver->save();
        return redirect()->route('admin.driver')->with('success', 'Driver added successfully');
    }

    public function updateDriver(Request $request)
    {
        $request->validate([
            'nama_driver' => 'required|string|max:255',
            'nomor_hp_driver' => 'required|string|max:255',
            'nomor_polisi_kendaraan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);
        $driver = Driver::find($request->id);
        $driver->nama_driver = $request->nama_driver;
        $driver->nomor_hp_driver = $request->nomor_hp_driver;
        $driver->nomor_polisi_kendaraan = $request->nomor_polisi_kendaraan;
        $driver->keterangan = $request->keterangan;
        $driver->save();
        return redirect()->route('admin.driver')->with('success', 'Driver updated successfully');
    }

    public function deleteDriver($id)
    {
        $driver = Driver::find($id);
        $driver->delete();
        return redirect()->route('admin.driver')->with('success', 'Driver deleted successfully');
    }


    // Stock
    public function stock()
    {
        $products = Product::all();
        $gudangs = Gudang::all();
        $stocks = Stock::all();
        return view('admin.stock', compact('products', 'gudangs', 'stocks'));
    }


    // Supplier
    public function supplier()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier', compact('suppliers'));
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'nomor_hp_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string|max:255',
        ]);
        $supplier = new Supplier();
        $supplier->name = $request->nama_supplier;
        $supplier->slug = Str::slug($request->nama_supplier);
        $supplier->nomor_telepon = $request->nomor_hp_supplier;
        $supplier->alamat = $request->alamat_supplier;
        $supplier->save();
        return redirect()->route('admin.supplier')->with('success', 'Supplier added successfully');
    }

    public function updateSupplier(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'nomor_hp_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string|max:255',
        ]);
        $supplier = Supplier::find($request->id);
        $supplier->name = $request->nama_supplier;
        $supplier->slug = Str::slug($request->nama_supplier);
        $supplier->nomor_telepon = $request->nomor_hp_supplier;
        $supplier->alamat = $request->alamat_supplier;
        $supplier->save();
        return redirect()->route('admin.supplier')->with('success', 'Supplier updated successfully');
    }

    public function deleteSupplier($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('admin.supplier')->with('success', 'Supplier deleted successfully');
    }


    // Konsumen
    public function konsumen()
    {
        $konsumens = Konsumen::all();
        return view('admin.konsumen', compact('konsumens'));
    }

    public function storeKonsumen(Request $request)
    {
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'nomor_hp_konsumen' => 'required|string|max:255',
            'alamat_konsumen' => 'required|string|max:255',
        ]);
        $konsumen = new Konsumen();
        $konsumen->name = $request->nama_konsumen;
        $konsumen->slug = Str::slug($request->nama_konsumen);
        $konsumen->nomor_telepon = $request->nomor_hp_konsumen;
        $konsumen->alamat = $request->alamat_konsumen;
        $konsumen->save();
        return redirect()->route('admin.konsumen')->with('success', 'Konsumen added successfully');
    }

    public function updateKonsumen(Request $request)
    {
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'nomor_hp_konsumen' => 'required|string|max:255',
            'alamat_konsumen' => 'required|string|max:255',
        ]);
        $konsumen = Konsumen::find($request->id);
        $konsumen->name = $request->nama_konsumen;
        $konsumen->slug = Str::slug($request->nama_konsumen);
        $konsumen->nomor_telepon = $request->nomor_hp_konsumen;
        $konsumen->alamat = $request->alamat_konsumen;
        $konsumen->save();
        return redirect()->route('admin.konsumen')->with('success', 'Konsumen updated successfully');
    }

    public function deleteKonsumen($slug)
    {
        $konsumen = Konsumen::where('slug', $slug)->first();
        $konsumen->delete();
        return redirect()->route('admin.konsumen')->with('success', 'Konsumen deleted successfully');
    }

    // Account
    public function account()
    {
        $accounts = User::all();
        return view('admin.account', compact('accounts'));
    }

    public function addAccount()
    {
        return view('admin.add-account');
    }

    public function storeAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $account = new User();
        $account->name = $request->name;
        $account->level = $request->level;
        $account->email = $request->email;
        $account->password = Hash::make($request->password);
        $account->save();

        if ($account->level == 'supervisor') {
            return redirect()->route('admin.account.supervisor')->with('success', 'Account supervisor added successfully');
        } else if ($account->level == 'staff') {
            return redirect()->route('admin.account.staff')->with('success', 'Account staff added successfully');
        }
    }

    // Account Supervisor
    public function accountSupervisor()
    {
        $accounts = User::where('level', 'supervisor')->get();
        return view('admin.account-supervisor', compact('accounts'));
    }

    // Account Staff
    public function accountStaff()
    {
        $accounts = User::where('level', 'staff')->get();
        return view('admin.account-staff', compact('accounts'));
    }

    public function editAccount($id)
    {
        $account = User::find($id);
        return view('admin.edit-account', compact('account'));
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $account = User::find($request->id);
        $account->name = $request->name;
        $account->level = $request->level;
        $account->email = $request->email;
        if ($request->password) {
            $account->password = Hash::make($request->password);
        }
        $account->save();
        if ($account->level == 'supervisor') {
            return redirect()->route('admin.account.supervisor')->with('success', 'Account supervisor updated successfully');
        } else if ($account->level == 'staff') {
            return redirect()->route('admin.account.staff')->with('success', 'Account staff updated successfully');
        }
    }

    public function deleteAccount($id)
    {
        $account = User::find($id);
        $account->delete();
        return redirect()->back()->with('success', 'Account deleted successfully');
    }

    // Report
    public function addReportMasuk()
    {
        $stocks = Stock::all();
        $drivers = Driver::all();
        $suppliers = Supplier::all();
        $konsumens = Konsumen::all();
        $gudangs = Gudang::all();
        $products = Product::all();
        $gudangs = Gudang::all();
        return view('admin.add-report-masuk', compact('stocks', 'drivers', 'suppliers', 'konsumens', 'gudangs', 'products'));
    }
    public function storeReportMasuk(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'gudang_id' => 'required',
            'supplier_id' => 'required',
            'nomor_po' => 'nullable',
            'keterangan' => 'nullable',
        ]);
        //    check Berdasarkan product_id ada tidak
        $stock = Stock::where('product_id', $request->product_id)
            ->where('gudang_id', $request->gudang_id)
            ->first();
        if ($stock) {
            $stock->stock += $request->quantity;
            $stock->save();
        } else {
            $stock = new Stock();
            $stock->product_id = $request->product_id;
            $stock->gudang_id = $request->gudang_id;
            $stock->stock = $request->quantity;
            $stock->save();
        }
        $report = new Report();
        $report->stock_id = $stock->id;
        $report->supplier_id = $request->supplier_id;
        $report->gudang_id = $request->gudang_id;
        $report->nomor_po = $request->nomor_po;
        $report->keterangan = $request->keterangan;
        $report->quantity = $request->quantity;
        $report->jenis = 'masuk';
        $report->save();
        return redirect()->back()->with('success', 'Report added successfully');
    }


    public function addReportKeluar()
    {
        $stocks = Stock::all();
        $drivers = Driver::all();
        $konsumens = Konsumen::all();
        $gudangs = Gudang::all();
        $products = Product::all();
        return view('admin.add-report-keluar', compact('stocks', 'drivers', 'konsumens', 'gudangs', 'products'));
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
        return redirect()->route('admin.add.product.surat.jalan', $suratJalan->kode)->with('success', 'Report keluar added successfully');
    }

    public function addProductSuratJalan($code)
    {
        $suratJalan = SuratJalan::where('kode', $code)->first();
        $products = Product::all();
        $gudangs = Gudang::all();
        $productSuratJalans = SuratJalanProduct::where('surat_jalan_id', $suratJalan->id)->get();
        return view('admin.add-product-surat-jalan', compact('suratJalan', 'productSuratJalans', 'products', 'gudangs'));
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

    public function deleteProductSuratJalan($id)
    {
        $suratJalanProduct = SuratJalanProduct::find($id);
        // Tambahkan stock sesuai dengan qty yang dihapus
        $stock = Stock::find($suratJalanProduct->stock_id);
        $stock->stock += $suratJalanProduct->qty;
        $stock->save();
        $suratJalanProduct->delete();
        return redirect()->back()->with('success', 'Product surat jalan deleted successfully');
    }

    public function cetakSuratJalanExcel($code)
    {
        $suratJalan = SuratJalan::where('kode', $code)->first();
        $suratJalanProducts = SuratJalanProduct::where('surat_jalan_id', $suratJalan->id)->get();
        // return view('admin.export.surat-jalan-excel', compact('suratJalan', 'suratJalanProducts'));
        return Excel::download(new ExportSuratJalan($suratJalan, $suratJalanProducts), 'surat-jalan-' . $suratJalan->kode . '.xlsx');
    }

    




    // History Report
    public function reportMasuk()
    {
        $reports = Report::where('jenis', 'masuk')->latest()->get();
        return view('admin.report-history-masuk', compact('reports'));
    }

    public function reportKeluar()
    {
        $reports = SuratJalanProduct::latest()->get();
        return view('admin.report-history-product-keluar', compact('reports'));
    }

    public function reportSuratJalan()
    {
        $reports = SuratJalan::latest()->get();
        return view('admin.report-history-keluar', compact('reports'));
    }


    // Transfer Stock
    public function transferStock()
    {
        $transfers = TransferStock::all();
        $stocks = Stock::all();
        return view('admin.transfer-stock', compact('transfers', 'stocks'));
    }
    public function addTransferStock()
    {
        $products = Product::all();
        $gudangs = Gudang::all();
        return view('admin.add-transfer-stock', compact('products', 'gudangs'));
    }
    public function storeTransferStock(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'gudang_tujuan' => 'required',
            'gudang_awal' => 'required',
            'quantity' => 'required',
            'keterangan' => 'nullable',
        ]);

        $stockAwal = Stock::where('product_id', $request->product_id)
            ->where('gudang_id', $request->gudang_awal)
            ->first();
        if (!$stockAwal) {
            return redirect()->back()->with('error', 'Stock product tidak ada');
        }
        if ($stockAwal->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stock product tidak cukup');
        }

        $stockTujuan = Stock::where('product_id', $request->product_id)
            ->where('gudang_id', $request->gudang_tujuan)
            ->first();

        if (!$stockTujuan) {
            $stockTujuan = new Stock();
            $stockTujuan->product_id = $request->product_id;
            $stockTujuan->gudang_id = $request->gudang_tujuan;
            $stockTujuan->stock = $request->quantity;
            $stockTujuan->save();
        } else {
            $stockTujuan->stock += $request->quantity;
            $stockTujuan->save();
        }

        $stockAwal->stock -= $request->quantity;
        $stockAwal->save();

        $transfer = new TransferStock();
        $transfer->product_id = $request->product_id;
        $transfer->gudang_tujuan = $request->gudang_tujuan;
        $transfer->gudang_awal = $request->gudang_awal;
        $transfer->quantity = $request->quantity;
        $transfer->keterangan = $request->keterangan;
        $transfer->save();

        return redirect()->back()->with('success', 'Transfer stock added successfully');
    }

    public function transferStockFilter(Request $request)
    {
        $transfers = TransferStock::whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $from = $request->from;
        $to = $request->to;
        return view('admin.transfer-stock-filter', compact('transfers', 'from', 'to'));
    }


    // Stock Opname
    public function stockOpname()
    {
        $stockOpnames = StockOpname::latest()->get();
        $stocks = Stock::all();
        return view('admin.stock-opname', compact('stockOpnames', 'stocks'));
    }
    public function stockOpnameFilter(Request $request)
    {
        $stockOpnames = StockOpname::whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $from = $request->from;
        $to = $request->to;
        return view('admin.stock-opname-filter', compact('stockOpnames', 'from', 'to'));
    }

    public function addStockOpname()
    {
        $products = Product::all();
        $gudangs = Gudang::all();
        return view('admin.add-stock-opname', compact('products', 'gudangs'));
    }


    public function storeStockOpname(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'gudang_id' => 'required',
            'stock_actual' => 'required',
            'keterangan' => 'nullable',
        ]);

        // Cek Stock 
        $stock = Stock::where('product_id', $request->product_id)
            ->where('gudang_id', $request->gudang_id)
            ->first();
        if (!$stock) {
            $newStock = new Stock();
            $newStock->product_id = $request->product_id;
            $newStock->gudang_id = $request->gudang_id;
            $newStock->stock = $request->stock_actual;
            $newStock->save();
            if ($newStock) {
                $stockOpname = new StockOpname();
                $stockOpname->stock_id = $newStock->id;
                $stockOpname->stock_tercatat = 0;
                $stockOpname->jumlah_aktual = $request->stock_actual;
                $stockOpname->keterangan = $request->keterangan;
                $stockOpname->save();
                return redirect()->back()->with('success', 'Stock opname added successfully');
            }
        } else {
            // JIka Stock Ada Update stock nya
            $stockLama = $stock->stock;
            $stock->stock = $request->stock_actual;
            $stock->save();
            $stockOpname = new StockOpname();
            $stockOpname->stock_id = $stock->id;
            $stockOpname->stock_tercatat = $stockLama;
            $stockOpname->jumlah_aktual = $request->stock_actual;
            $stockOpname->keterangan = $request->keterangan;
            $stockOpname->save();
            return redirect()->back()->with('success', 'Stock opname added successfully');
        }
    }


    // filter History Report
    public function reportHistoryMasukFilter(Request $request)
    {
        $reports = Report::where('jenis', 'masuk')
            ->whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $from = $request->from;
        $to = $request->to;

        return view('admin.report-history-masuk-filter', compact('reports', 'from', 'to'));
    }

    public function reportHistoryProductKeluarFilter(Request $request)
    {
        $reports = SuratJalanProduct::whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $from = $request->from;
        $to = $request->to;
        return view('admin.report-history-product-keluar-filter', compact('reports', 'from', 'to'));
    }


    // Download Excel
    public function downloadReportMasukExcel($from, $to)
    {
        return Excel::download(new ExportReportMasuk($from, $to), 'report-masuk.xlsx');
    }

    public function downloadReportKeluarExcel($from, $to)
    {
        return Excel::download(new ExportReportKeluar($from, $to), 'report-keluar.xlsx');
    }

    public function downloadTransferStockExcel($from, $to)
    {
        return Excel::download(new ExportTransferStock($from, $to), 'transfer-stock.xlsx');
    }

    public function downloadStockOpnameExcel($from, $to)
    {
        return Excel::download(new ExportStockOpname($from, $to), 'stock-opname.xlsx');
    }

    public function downloadReportHistoryProductKeluarExcel($from, $to)
    {
        return Excel::download(new ExportReportBarangKeluar($from, $to), 'report-history-product-keluar.xlsx');
    }
}
