<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupervisorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');

// Register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('registerPost');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// admin middleware
Route::group(['middleware' => ['authCheck:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Product
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.product');
    Route::get('/admin/product/add', [AdminController::class, 'addProduct'])->name('admin.product-add');
    Route::post('/admin/product/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::get('/admin/product/edit/{slug}', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::post('/admin/product/update', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::get('/admin/product/delete/{slug}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');


    // Category
    Route::get('/admin/category', [AdminController::class, 'categories'])->name('admin.category');
    Route::post('/admin/category/store', [AdminController::class, 'storeCategory'])->name('admin.category.store');
    Route::post('/admin/category/update', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::get('/admin/category/delete/{id}', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');

    // Unit
    Route::get('/admin/unit', [AdminController::class, 'units'])->name('admin.unit');
    Route::post('/admin/unit/store', [AdminController::class, 'storeUnit'])->name('admin.unit.store');
    Route::post('/admin/unit/update', [AdminController::class, 'updateUnit'])->name('admin.unit.update');
    Route::get('/admin/unit/delete/{id}', [AdminController::class, 'deleteUnit'])->name('admin.unit.delete');

    // Gudang
    Route::get('/admin/gudang', [AdminController::class, 'gudang'])->name('admin.gudang');
    Route::post('/admin/gudang/store', [AdminController::class, 'storeGudang'])->name('admin.gudang.store');
    Route::post('/admin/gudang/update', [AdminController::class, 'updateGudang'])->name('admin.gudang.update');
    Route::get('/admin/gudang/delete/{slug}', [AdminController::class, 'deleteGudang'])->name('admin.gudang.delete');

    // Driver
    Route::get('/admin/driver', [AdminController::class, 'driver'])->name('admin.driver');
    Route::post('/admin/driver/store', [AdminController::class, 'storeDriver'])->name('admin.driver.store');
    Route::post('/admin/driver/update', [AdminController::class, 'updateDriver'])->name('admin.driver.update');
    Route::get('/admin/driver/delete/{id}', [AdminController::class, 'deleteDriver'])->name('admin.driver.delete');

    // Stock
    Route::get('/admin/stock', [AdminController::class, 'stock'])->name('admin.stock');
    Route::get('/admin/stock/{slug}', [AdminController::class, 'stockGudang'])->name('admin.stock.gudang');

    // Supplier 
    Route::get('/admin/supplier', [AdminController::class, 'supplier'])->name('admin.supplier');
    Route::post('/admin/supplier/store', [AdminController::class, 'storeSupplier'])->name('admin.supplier.store');
    Route::post('/admin/supplier/update', [AdminController::class, 'updateSupplier'])->name('admin.supplier.update');
    Route::get('/admin/supplier/delete/{slug}', [AdminController::class, 'deleteSupplier'])->name('admin.supplier.delete');

    // Konsumen
    Route::get('/admin/konsumen', [AdminController::class, 'konsumen'])->name('admin.konsumen');
    Route::post('/admin/konsumen/store', [AdminController::class, 'storeKonsumen'])->name('admin.konsumen.store');
    Route::post('/admin/konsumen/update', [AdminController::class, 'updateKonsumen'])->name('admin.konsumen.update');
    Route::get('/admin/konsumen/delete/{slug}', [AdminController::class, 'deleteKonsumen'])->name('admin.konsumen.delete');

    // Account
    Route::get('/admin/account', [AdminController::class, 'account'])->name('admin.account');
    Route::get('/admin/account/add', [AdminController::class, 'addAccount'])->name('admin.account.add');
    Route::post('/admin/account/store', [AdminController::class, 'storeAccount'])->name('admin.account.store');

    // Account Supervisor
    Route::get('/admin/account/supervisor', [AdminController::class, 'accountSupervisor'])->name('admin.account.supervisor');
    Route::get('/admin/account/staff', [AdminController::class, 'accountStaff'])->name('admin.account.staff');
    Route::get('/admin/account/edit/{id}', [AdminController::class, 'editAccount'])->name('admin.account.edit');
    Route::post('/admin/account/update', [AdminController::class, 'updateAccount'])->name('admin.account.update');
    Route::get('/admin/account/delete/{id}', [AdminController::class, 'deleteAccount'])->name('admin.account.delete');


    // Report
    Route::get('/admin/report/masuk', [AdminController::class, 'reportMasuk'])->name('admin.report.masuk');
    Route::get('/admin/report/keluar', [AdminController::class, 'reportKeluar'])->name('admin.report.keluar');
    Route::get('/admin/report/surat-jalan', [AdminController::class, 'reportSuratJalan'])->name('admin.report.surat.jalan');
    Route::get('/admin/report/add/masuk', [AdminController::class, 'addReportMasuk'])->name('admin.add.report.masuk');
    Route::get('/admin/report/add/keluar', [AdminController::class, 'addReportKeluar'])->name('admin.add.report.keluar');

    Route::post('/admin/report/masuk/store', [AdminController::class, 'storeReportMasuk'])->name('admin.report.masuk.store');
    Route::post('/admin/report/keluar/store', [AdminController::class, 'storeReportKeluar'])->name('admin.report.keluar.store');

    // Transfer Stock
    Route::get('/admin/transfer-stock', [AdminController::class, 'transferStock'])->name('admin.transfer.stock');
    Route::get('/admin/transfer-stock/create', [AdminController::class, 'addTransferStock'])->name('admin.transfer.stock.create');
    Route::post('/admin/transfer-stock/store', [AdminController::class, 'storeTransferStock'])->name('admin.transfer.stock.store');
    Route::post('/admin/transfer-stock/update', [AdminController::class, 'updateTransferStock'])->name('admin.transfer.stock.update');
    Route::get('/admin/transfer-stock/delete/{id}', [AdminController::class, 'deleteTransferStock'])->name('admin.transfer.stock.delete');

    // Filter Transfer Stock
    Route::get('/admin/transfer-stock/filter', [AdminController::class, 'transferStockFilter'])->name('admin.transfer.stock.filter');

    // Stock Opname 
    Route::get('/admin/stock-opname', [AdminController::class, 'stockOpname'])->name('admin.stock.opname');
    Route::get('/admin/stock-opname/create', [AdminController::class, 'addStockOpname'])->name('admin.stock.opname.create');
    Route::post('/admin/stock-opname/store', [AdminController::class, 'storeStockOpname'])->name('admin.stock.opname.store');
    Route::post('/admin/stock-opname/update', [AdminController::class, 'updateStockOpname'])->name('admin.stock.opname.update');
    Route::get('/admin/stock-opname/delete/{id}', [AdminController::class, 'deleteStockOpname'])->name('admin.stock.opname.delete');


    // Filter Report History
    Route::get('/admin/report/history/masuk/filter', [AdminController::class, 'reportHistoryMasukFilter'])->name('admin.report.history.masuk.filter');

    // Filter Stock Opname
    Route::get('/admin/stock-opname/filter', [AdminController::class, 'stockOpnameFilter'])->name('admin.stock.opname.filter');

    // Filter Report History
    Route::get('/admin/report/history/keluar/filter', [AdminController::class, 'reportHistoryProductKeluarFilter'])->name('admin.report.history.keluar.filter');


    // Download Excel 
    Route::get('admin/report/masuk/download/excel/{from}/{to}', [AdminController::class, 'downloadReportMasukExcel'])->name('admin.report.masuk.download.excel');
    Route::get('admin/transfer-stock/download/excel/{from}/{to}', [AdminController::class, 'downloadTransferStockExcel'])->name('admin.transfer.stock.download.excel');
    Route::get('admin/stock-opname/download/excel/{from}/{to}', [AdminController::class, 'downloadStockOpnameExcel'])->name('admin.stock.opname.download.excel');
    Route::get('admin/report/history/keluar/download/excel/{from}/{to}', [AdminController::class, 'downloadReportHistoryProductKeluarExcel'])->name('admin.report.history.keluar.download.excel');
    // Surat Jalan
    Route::get('/admin/surat-jalan/{code}', [AdminController::class, 'addProductSuratJalan'])->name('admin.add.product.surat.jalan');
    Route::post('/admin/surat-jalan/store', [AdminController::class, 'storeProductSuratJalan'])->name('admin.store.product.surat.jalan');
    Route::get('/admin/surat-jalan/delete/{id}', [AdminController::class, 'deleteProductSuratJalan'])->name('admin.delete.product.surat.jalan');

    // Cetak Surat Jalan
    Route::get('/admin/cetak/surat-jalan/{code}', [AdminController::class, 'cetakSuratJalan'])->name('admin.cetak.surat.jalan');
    Route::get('/admin/cetak/surat-jalan/excel/{code}', [AdminController::class, 'cetakSuratJalanExcel'])->name('admin.cetak.surat.jalan.excel');
});


// Supervisor middleware
Route::group(['middleware' => ['authCheck:supervisor']], function () {
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'index'])->name('supervisor.dashboard');
});

// Staff middleware
Route::group(['middleware' => ['authCheck:staff']], function () {
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
});
