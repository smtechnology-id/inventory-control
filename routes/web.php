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

    // Filter Product
    Route::get('/admin/product/filter', [AdminController::class, 'productFilter'])->name('admin.product.filter');
    Route::get('/admin/product/export/{gudang}', [AdminController::class, 'exportProduct'])->name('admin.product.download.filter');


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
    // Account Admin
    Route::get('/admin/account/admin', [AdminController::class, 'accountAdmin'])->name('admin.account.admin');
    // Account Staff
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

    // Edit Report Masuk
    Route::get('/admin/report/masuk/edit/{id}', [AdminController::class, 'editReportMasuk'])->name('admin.report.masuk.edit');
    Route::post('/admin/report/masuk/update', [AdminController::class, 'updateReportMasuk'])->name('admin.report.masuk.update');
    Route::get('/admin/report/masuk/delete/{id}', [AdminController::class, 'deleteReportMasuk'])->name('admin.report.masuk.delete');


    // Edit Report Keluar
    Route::post('/admin/report/keluar/update', [AdminController::class, 'updateReportKeluar'])->name('admin.report.keluar.update');
    Route::get('/admin/report/keluar/delete/{id}', [AdminController::class, 'deleteReportKeluar'])->name('admin.report.keluar.delete');

    // Transfer Stock
    Route::get('/admin/transfer-stock', [AdminController::class, 'transferStock'])->name('admin.transfer.stock');
    Route::get('/admin/transfer-stock/create', [AdminController::class, 'addTransferStock'])->name('admin.transfer.stock.create');
    Route::post('/admin/transfer-stock/store', [AdminController::class, 'storeTransferStock'])->name('admin.transfer.stock.store');
    Route::post('/admin/transfer-stock/update', [AdminController::class, 'updateTransferStock'])->name('admin.transfer.stock.update');
    Route::get('/admin/transfer-stock/delete/{id}', [AdminController::class, 'deleteTransferStock'])->name('admin.transfer.stock.delete');
    Route::get('/admin/transfer-stock/add-product/{nomor_do}', [AdminController::class, 'addProductTransferStock'])->name('admin.add-product-transfer-stock');
    Route::post('/admin/transfer-stock/store-product', [AdminController::class, 'storeTransferStockProduct'])->name('admin.store.transfer.stock.product');

    Route::get('/admin/transfer-stock/delete-product/{id}', [AdminController::class, 'deleteTransferStockProduct'])->name('admin.delete.product.transfer.stock');

    // Cetak Transfer Stock
    Route::get('/admin/cetak/transfer-stock/pdf/{nomor_do}', [AdminController::class, 'cetakTransferStockPdf'])->name('admin.cetak.transfer.stock.pdf');

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

    // Export Transfer Stock Single
    Route::get('/admin/cetak/transfer-stock/single/{nomor_do}', [AdminController::class, 'cetakTransferStockSingle'])->name('admin.cetak.transfer.stock.single');

    // Cetak PDF
    Route::get('/admin/cetak/surat-jalan/pdf/{nomor_do}', [AdminController::class, 'cetakSuratJalanPdf'])->name('admin.cetak.surat.jalan.pdf');
});


// Supervisor middleware
Route::group(['middleware' => ['authCheck:supervisor']], function () {
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'index'])->name('supervisor.dashboard');

    // Product
    Route::get('/supervisor/product', [SupervisorController::class, 'product'])->name('supervisor.product');

    // Category
    Route::get('/supervisor/category', [SupervisorController::class, 'category'])->name('supervisor.category');

    // Unit
    Route::get('/supervisor/unit', [SupervisorController::class, 'unit'])->name('supervisor.unit');

    // Stock
    Route::get('/supervisor/stock', [SupervisorController::class, 'stock'])->name('supervisor.stock');

    // Report
    Route::get('/supervisor/report/masuk', [SupervisorController::class, 'reportMasuk'])->name('supervisor.report.masuk');
    Route::get('/supervisor/report/keluar', [SupervisorController::class, 'reportKeluar'])->name('supervisor.report.keluar');
    Route::get('/supervisor/report/surat-jalan', [SupervisorController::class, 'reportSuratJalan'])->name('supervisor.report.surat.jalan');

    // Transfer Stock
    Route::get('/supervisor/transfer-stock', [SupervisorController::class, 'transferStock'])->name('supervisor.transfer.stock');

    // Stock Opname 
    Route::get('/supervisor/stock-opname', [SupervisorController::class, 'stockOpname'])->name('supervisor.stock.opname');

    // Gudang
    Route::get('/supervisor/gudang', [SupervisorController::class, 'gudang'])->name('supervisor.gudang');

    // Driver
    Route::get('/supervisor/driver', [SupervisorController::class, 'driver'])->name('supervisor.driver');

    // Supplier
    Route::get('/supervisor/supplier', [SupervisorController::class, 'supplier'])->name('supervisor.supplier');

    // Konsumen
    Route::get('/supervisor/konsumen', [SupervisorController::class, 'konsumen'])->name('supervisor.konsumen');

    // Account
    Route::get('/supervisor/account/supervisor', [SupervisorController::class, 'accountSupervisor'])->name('supervisor.account.supervisor');
    Route::get('/supervisor/account/staff', [SupervisorController::class, 'accountStaff'])->name('supervisor.account.staff');
    
    // Surat Masuk
    Route::get('/supervisor/surat-masuk', [SupervisorController::class, 'suratMasuk'])->name('supervisor.surat.masuk');
    Route::get('/supervisor/report/history/masuk/filter', [SupervisorController::class, 'reportHistoryMasukFilter'])->name('supervisor.report.history.masuk.filter');
    Route::get('/supervisor/report/history/masuk/download/excel/{from}/{to}', [AdminController::class, 'downloadReportMasukExcel'])->name('supervisor.report.history.masuk.download.excel');

    // Surat Keluar
    Route::get('/supervisor/report/history/keluar', [SupervisorController::class, 'reportKeluar'])->name('supervisor.report.keluar');
    Route::get('/supervisor/report/history/keluar/filter', [SupervisorController::class, 'reportHistoryProductKeluarFilter'])->name('supervisor.report.history.keluar.filter');
    Route::get('/supervisor/report/history/keluar/download/excel/{from}/{to}', [AdminController::class, 'downloadReportMasukExcel'])->name('supervisor.report.history.keluar.download.excel');

    // Stock Opname
    Route::get('/supervisor/stock-opname', [SupervisorController::class, 'stockOpname'])->name('supervisor.stock.opname');

    Route::get('/supervisor/surat-jalan/{code}', [SupervisorController::class, 'addProductSuratJalan'])->name('supervisor.add.product.surat.jalan');

    Route::get('/supervisor/cetak/surat-jalan/excel/{code}', [SupervisorController::class, 'cetakSuratJalanExcel'])->name('supervisor.cetak.surat.jalan.excel');


    // Account
    Route::get('/supervisor/account', [SupervisorController::class, 'account'])->name('supervisor.account');
    Route::get('/supervisor/account/add', [SupervisorController::class, 'addAccount'])->name('supervisor.account.add');
    Route::post('/supervisor/account/store', [SupervisorController::class, 'storeAccount'])->name('supervisor.account.store');

    // Account Supervisor
    Route::get('/supervisor/account/supervisor', [SupervisorController::class, 'accountSupervisor'])->name('supervisor.account.supervisor');
    Route::get('/supervisor/account/staff', [SupervisorController::class, 'accountStaff'])->name('supervisor.account.staff');
    Route::get('/supervisor/account/edit/{id}', [SupervisorController::class, 'editAccount'])->name('supervisor.account.edit');
    Route::post('/supervisor/account/update', [SupervisorController::class, 'updateAccount'])->name('supervisor.account.update');
    Route::get('/supervisor/account/delete/{id}', [SupervisorController::class, 'deleteAccount'])->name('supervisor.account.delete');

});

// Staff middleware
Route::group(['middleware' => ['authCheck:staff']], function () {
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/add/report/keluar', [StaffController::class, 'addReportKeluar'])->name('staff.add.report.keluar');
    Route::post('/staff/report/keluar/store', [StaffController::class, 'storeReportKeluar'])->name('staff.report.keluar.store');
    Route::get('/staff/add/product/surat-jalan/{code}', [StaffController::class, 'addProductSuratJalan'])->name('staff.add.product.surat.jalan');
});
