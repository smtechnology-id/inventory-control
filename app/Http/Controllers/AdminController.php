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
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransferStock;
use App\Exports\ExportSuratJalan;
use App\Models\SuratJalanProduct;
use App\Exports\ExportReportMasuk;
use App\Exports\ExportStockOpname;
use App\Exports\ExportReportKeluar;
use App\Exports\ExportTransferStock;
use App\Models\TransferStockProduct;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportReportBarangKeluar;
use App\Exports\ExportTransferStockSingle;

use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        $totalBarang = Product::count();
        $gudang = Gudang::count();
        $product = Product::all();
        $user = User::count();
        // Priduct Kritis
        $productKritis = Product::whereColumn('stock', '<=', 'stock_minimal')->get(); // Corrected comparison
        return view('admin.dashboard', compact('totalBarang', 'gudang', 'productKritis', 'user'));
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
        if (Gudang::count() == 0) {
            return redirect()->route('admin.gudang')->with('error', 'Gudang tidak ada, silahkan tambahkan gudang terlebih dahulu');
        }
        $categories = Category::all();
        $units = Unit::all();
        $gudangs = Gudang::all();
        return view('admin.add-product', compact('categories', 'units', 'gudangs'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'unit_id' => 'required',
            'nomor_material' => 'required',
            'kode_barang' => 'required',
            'name' => 'required',
            'stock_minimal' => 'required',
            'keterangan' => 'nullable',
            'gudang_id' => 'required',
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->nomor_material = $request->nomor_material;
        $product->kode_barang = $request->kode_barang;
        $product->nama_barang = $request->name;
        $product->stock_minimal = $request->stock_minimal;
        $product->keterangan = $request->keterangan;
        $product->slug = Str::slug($request->name . '-' . $request->kode_barang);
        $product->gudang_id = $request->gudang_id;
        $product->stock = 0;
        $product->save();
        return redirect()->route('admin.product')->with('success', 'Product added successfully');
    }

    public function editProduct($slug)
    {
        $categories = Category::all();
        $units = Unit::all();
        $product = Product::where('slug', $slug)->first();
        $gudangs = Gudang::all();
        return view('admin.edit-product', compact('product', 'categories', 'units', 'gudangs'));
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'unit_id' => 'required',
            'nomor_material' => 'required',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'stock_minimal' => 'required',
            'keterangan' => 'nullable',
        ]);

        $product = Product::where('id', $request->id)->first();
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->nomor_material = $request->nomor_material;
        $product->kode_barang = $request->kode_barang;
        $product->nama_barang = $request->nama_barang;
        $product->stock_minimal = $request->stock_minimal;
        $product->keterangan = $request->keterangan;
        $product->gudang_id = $request->gudang_id;
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
        return view('admin.stock', compact('products'));
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
    public function accountAdmin()
    {
        $accounts = User::where('level', 'admin')->get();
        return view('admin.account-supervisor', compact('accounts'));
    }
    // Account Ad
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
        $konsumens = Konsumen::all();
        $gudangs = Gudang::all();
        $products = Product::all();
        return view('admin.add-report-masuk', compact('products', 'konsumens', 'gudangs'));
    }
    public function storeReportMasuk(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'nomor_po' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        // Check product_id ada tidak
        $product = Product::find($request->product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product tidak ada');
        }

        // Add Quantity
        $product->stock += $request->quantity;
        $product->save();

        // Add Report
        $report = new Report();
        $report->product_id = $request->product_id;
        $report->nomor_po = $request->nomor_po;
        $report->keterangan = $request->keterangan;
        $report->quantity = $request->quantity;
        $report->save();
        return redirect()->route('admin.report.masuk')->with('success', 'Report added successfully');
    }

    public function editReportMasuk($id)
    {
        $report = Report::find($id);
        $products = Product::where('id', $report->product_id)->get();
        return view('admin.edit-report-masuk', compact('report', 'products'));
    }

    public function updateReportMasuk(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'nomor_po' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        $report = Report::find($request->id);
        // Hitung selisih quantity
        $selisih = $request->quantity - $report->quantity;
        // Update Stock
        $product = Product::find($request->product_id);

        $product->stock += $selisih;
        $product->save();

        $report->nomor_po = $request->nomor_po;
        $report->keterangan = $request->keterangan;
        $report->quantity = $request->quantity;
        $report->save();
        return redirect()->route('admin.report.masuk')->with('success', 'Report updated successfully');
    }

    public function deleteReportMasuk($id)
    {
        $report = Report::find($id);
        $product = Product::find($report->product_id);
        $product->stock -= $report->quantity;
        $product->save();
        $report->delete();
        return redirect()->back()->with('success', 'Report deleted successfully');
    }

    public function addReportKeluar()
    {
        $konsumens = Konsumen::all();
        $products = Product::all();
        return view('admin.add-report-keluar', compact('products', 'konsumens'));
    }

    public function storeReportKeluar(Request $request)
    {
        $request->validate([
            'konsumen_id' => 'required',
            'via' => 'required',
            'carrier' => 'required',
            'reff' => 'required',
            'truck_number' => 'required',
            'delivered_by' => 'required',
        ]);

        // No DO mengambil urutan terakhir contoh 0001
        $lastSuratJalan = SuratJalan::latest()->first();
        $lastNumber = $lastSuratJalan ? intval(substr($lastSuratJalan->nomor_do, -4)) + 1 : 1;
        $formattedNumber = str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
        $nomorDo = $formattedNumber;

        $suratJalan = new SuratJalan();
        $suratJalan->konsumen_id = $request->konsumen_id;
        $suratJalan->nomor_do = $nomorDo;
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
            'qty' => 'required',
            'keterangan' => 'nullable',
        ]);

        $product = Product::find($request->product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product tidak ada');
        } else {
            if ($product->stock < $request->qty) {
                return redirect()->back()->with('error', 'Stock product tidak cukup');
            }

            // Cek apaka produk sudah pernah ditambahkan
            $suratJalanProduct = SuratJalanProduct::where('surat_jalan_id', $request->surat_jalan_id)
                ->where('product_id', $request->product_id)
                ->first();
            if ($suratJalanProduct) {
                // Tambahkan quantity
                $suratJalanProduct->qty += $request->qty;
                $suratJalanProduct->save();

                $product->stock -= $request->qty;
                $product->save();
                return redirect()->back()->with('success', 'Product surat jalan updated successfully');
            }

            $product->stock -= $request->qty;
            $product->save();

            $suratJalanProduct = new SuratJalanProduct();
            $suratJalanProduct->surat_jalan_id = $request->surat_jalan_id;
            $suratJalanProduct->product_id = $request->product_id;
            $suratJalanProduct->qty = $request->qty;
            $suratJalanProduct->keterangan = $request->keterangan;
            $suratJalanProduct->save();
        }

        return redirect()->back()->with('success', 'Product surat jalan added successfully');
    }

    public function deleteProductSuratJalan($id)
    {
        $suratJalanProduct = SuratJalanProduct::find($id);
        $product = Product::find($suratJalanProduct->product_id);
        $product->stock += $suratJalanProduct->qty;
        $product->save();
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
        $reports = Report::latest()->get();
        return view('admin.report-history-masuk', compact('reports'));
    }

    public function reportKeluar()
    {
        $suratJalans = SuratJalan::all();
        $reports = SuratJalanProduct::latest()->get();
        return view('admin.report-history-product-keluar', compact('reports', 'suratJalans'));
    }
    public function updateReportKeluar(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'qty' => 'required',
            'keterangan' => 'nullable',
        ]);

        $report = SuratJalanProduct::find($request->id);

        // Hitung selisih quantity
        $selisih = $request->qty - $report->qty;

        // Update Stock
        if ($request->qty > $report->qty) {
            $product = Product::find($report->product_id);
            $product->stock += $selisih;
            $product->save();
        } else {
            $product = Product::find($report->product_id);
            $product->stock -= $selisih;
            $product->save();
        }


        $report->qty = $request->qty;
        $report->keterangan = $request->keterangan;
        $report->save();
        return redirect()->back()->with('success', 'Report keluar updated successfully');
    }

    public function reportSuratJalan()
    {
        $reports = SuratJalan::latest()->get();
        return view('admin.report-history-keluar', compact('reports'));
    }


    // Transfer Stock
    public function transferStock()
    {
        $transfers = TransferStock::latest()->get();
        return view('admin.transfer-stock', compact('transfers'));
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
            'gudang_awal' => 'required',
            'gudang_tujuan' => 'required',
            'attendant' => 'required',
            'via' => 'required',
            'carrier' => 'required',
            'keterangan' => 'nullable',
            'refrensi' => 'required',
            'lokasi_kirim' => 'required',
            'truck_number' => 'required',
            'delivered_by' => 'required',

        ]);


        // product awal dan tujuan tidak boleh sama
        if ($request->gudang_awal == $request->gudang_tujuan) {
            return redirect()->back()->with('error', 'Gudang awal dan tujuan tidak boleh sama');
        }

        // Ambil nomor do dengan format 0001
        $lastTransfer = TransferStock::latest()->first();
        $lastNumber = $lastTransfer ? intval(substr($lastTransfer->nomor_do, -4)) + 1 : 1;
        $formattedNumber = str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
        $nomorDo = $formattedNumber;

        $transfer = new TransferStock();
        $transfer->nomor_do = $nomorDo;
        $transfer->gudang_awal = $request->gudang_awal;
        $transfer->gudang_tujuan = $request->gudang_tujuan;
        $transfer->attendant = $request->attendant;
        $transfer->via = $request->via;
        $transfer->carrier = $request->carrier;
        $transfer->keterangan = $request->keterangan;
        $transfer->refrensi = $request->refrensi;
        $transfer->lokasi_kirim = $request->lokasi_kirim;
        $transfer->truck_number = $request->truck_number;
        $transfer->delivered_by = $request->delivered_by;
        $transfer->save();

        return redirect()->route('admin.add-product-transfer-stock', $transfer->nomor_do)->with('success', 'Transfer stock added successfully');
    }

    public function storeTransferStockProduct(Request $request)
    {
        $request->validate([
            'product_gudang_awal_id' => 'required',
            'product_gudang_tujuan_id' => 'required',
            'qty' => 'required',
            'keterangan' => 'nullable',
        ]);

        // Cek apakah product gudang awal ada
        $productGudangAwal = Product::find($request->product_gudang_awal_id);
        if (!$productGudangAwal) {
            return redirect()->back()->with('error', 'Product gudang awal tidak ada');
        }

        // Cek apakah product gudang tujuan ada
        $productGudangTujuan = Product::find($request->product_gudang_tujuan_id);
        if (!$productGudangTujuan) {
            return redirect()->back()->with('error', 'Product gudang tujuan tidak ada');
        }

        // Cek apakah stock product gudang awal cukup
        if ($productGudangAwal->stock < $request->qty) {
            return redirect()->back()->with('error', 'Stock product gudang awal tidak cukup');
        }

        // Proses transfer stock
        $productGudangAwal->stock -= $request->qty;
        $productGudangAwal->save();

        $productGudangTujuan->stock += $request->qty;
        $productGudangTujuan->save();


        $transfer = TransferStock::where('nomor_do', $request->nomor_do)->first();

        $transferProduct = new TransferStockProduct();
        $transferProduct->transfer_stock_id = $transfer->id;
        $transferProduct->product_gudang_awal_id = $request->product_gudang_awal_id;
        $transferProduct->product_gudang_tujuan_id = $request->product_gudang_tujuan_id;
        $transferProduct->qty = $request->qty;
        $transferProduct->keterangan = $request->keterangan;
        $transferProduct->save();

        return redirect()->back()->with('success', 'Product transfer stock added successfully');
    }

    public function addProductTransferStock($nomor_do)
    {
        $transfer = TransferStock::where('nomor_do', $nomor_do)->first();
        $productGudangAwal = Product::where('gudang_id', $transfer->gudang_awal)->get();
        $productGudangTujuan = Product::where('gudang_id', $transfer->gudang_tujuan)->get();
        $transferProducts = TransferStockProduct::where('transfer_stock_id', $transfer->id)->get();
        $products = Product::all();
        return view('admin.add-product-transfer-stock', compact('transfer', 'productGudangAwal', 'productGudangTujuan', 'transferProducts', 'products'));
    }

    public function transferStockFilter(Request $request)
    {
        if ($request->from == null) {
            return redirect()->back()->with('error', 'Tanggal dari tidak boleh kosong');
        }
        if ($request->to == null) {
            return redirect()->back()->with('error', 'Tanggal sampai tidak boleh kosong');
        }
        $transfers = TransferStock::whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $from = $request->from;
        $to = $request->to;
        return view('admin.transfer-stock-filter', compact('transfers', 'from', 'to'));
    }

    public function deleteTransferStockProduct($id)
    {

        // Cek apakah product gudang awal ada
        $transferProduct = TransferStockProduct::find($id);
        $productGudangAwal = Product::find($transferProduct->product_gudang_awal_id);
        $productGudangAwal->stock += $transferProduct->qty;
        $productGudangAwal->save();

        // Cek apakah product gudang tujuan ada
        $productGudangTujuan = Product::find($transferProduct->product_gudang_tujuan_id);
        $productGudangTujuan->stock -= $transferProduct->qty;
        $productGudangTujuan->save();

        $transferProduct->delete();
        return redirect()->back()->with('success', 'Product transfer stock deleted successfully');
    }


    // Stock Opname
    public function stockOpname()
    {
        $stockOpnames = StockOpname::latest()->get();
        return view('admin.stock-opname', compact('stockOpnames'));
    }
    public function stockOpnameFilter(Request $request)
    {
        if ($request->from == null) {
            return redirect()->back()->with('error', 'Tanggal dari tidak boleh kosong');
        }
        if ($request->to == null) {
            return redirect()->back()->with('error', 'Tanggal sampai tidak boleh kosong');
        }
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
            'stock_actual' => 'required',
            'keterangan' => 'nullable',
        ]);

        // Cek Stock 
        $product = Product::where('id', $request->product_id)
            ->first();

        // JIka Stock Ada Update stock nya
        $stockLama = $product->stock;
        $product->stock = $request->stock_actual;
        $product->save();


        $stockOpname = new StockOpname();
        $stockOpname->product_id = $product->id;
        $stockOpname->stock_tercatat = $stockLama;
        $stockOpname->jumlah_aktual = $request->stock_actual;
        $stockOpname->keterangan = $request->keterangan;
        $stockOpname->save();
        return redirect()->back()->with('success', 'Stock opname added successfully');
        
    }


    // filter History Report
    public function reportHistoryMasukFilter(Request $request)
    {
        if ($request->from == null) {
            return redirect()->back()->with('error', 'Tanggal dari tidak boleh kosong');
        }
        if ($request->to == null) {
            return redirect()->back()->with('error', 'Tanggal sampai tidak boleh kosong');
        }
        $reports = Report::whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $from = $request->from;
        $to = $request->to;

        return view('admin.report-history-masuk-filter', compact('reports', 'from', 'to'));
    }

    public function reportHistoryProductKeluarFilter(Request $request)
    {
        if ($request->from == null) {
            return redirect()->back()->with('error', 'Tanggal dari tidak boleh kosong');
        }
        if ($request->to == null) {
            return redirect()->back()->with('error', 'Tanggal sampai tidak boleh kosong');
        }
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

    public function cetakTransferStockSingle($nomor_do)
    {
        $transfer = TransferStock::where('nomor_do', $nomor_do)->first();
        return Excel::download(new ExportTransferStockSingle($transfer), 'transfer-stock.xlsx');
    }


    // Cetak PDF
    public function cetakTransferStockPdf($nomor_do)
    {
        $transfer = TransferStock::where('nomor_do', $nomor_do)->first();

        // $pdf = PDF::loadView('admin.pdf.transfer-stock', compact('transfer'));
        // return $pdf->stream($nomor_do.'-StockoutCMT-ELN-X-2024.pdf');

        return view('admin.pdf.transfer-stock', compact('transfer'));
    }
}
