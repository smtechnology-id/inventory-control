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
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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
            'price' => 'required',
            'stock_awal' => 'required',
            'stock_minimal' => 'required',
            'keterangan' => 'required',
        ]);

        $product = new Product();
        $product->category_id = $request->category;
        $product->unit_id = $request->unit;
        $product->nomor_material = $request->nomor_material;
        $product->kode_barang = $request->kode_barang;
        $product->nama_barang = $request->name;
        $product->harga = $request->price;
        $product->stock_awal = $request->stock_awal;
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
            'price' => 'required',
            'stock_awal' => 'required',
            'stock_minimal' => 'required',
            'keterangan' => 'required',
        ]);

        $product = Product::where('id', $request->id)->first();
        $product->category_id = $request->category;
        $product->unit_id = $request->unit;
        $product->nomor_material = $request->nomor_material;
        $product->kode_barang = $request->kode_barang;
        $product->nama_barang = $request->name;
        $product->harga = $request->price;
        $product->stock_awal = $request->stock_awal;
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
            'product_id' => 'required',
            'quantity' => 'required',
            'gudang_id' => 'required',
            'konsumen_id' => 'required',
            'nomor_do' => 'nullable',
            'keterangan' => 'nullable',
        ]);
        $stock = Stock::where('product_id', $request->product_id)
            ->where('gudang_id', $request->gudang_id)
            ->first();
        if ($stock) {
            $stock->stock -= $request->quantity;
            $stock->save();
        } else {
            return redirect()->back()->with('error', 'Stock tidak ada');
        }
        $report = new Report();
        $report->stock_id = $stock->id;
        $report->konsumen_id = $request->konsumen_id;
        $report->gudang_id = $request->gudang_id;
        $report->nomor_do = $request->nomor_do;
        $report->driver_id = $request->driver_id;
        $report->keterangan = $request->keterangan;
        $report->quantity = $request->quantity;
        $report->jenis = 'keluar';
        $report->save();
        return redirect()->back()->with('success', 'Report added successfully');
    }
}
