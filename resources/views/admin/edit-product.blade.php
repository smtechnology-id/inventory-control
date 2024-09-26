@extends('layouts.app')

@section('active_product', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Product</h1>
                <p>Edit product</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nomor_material" class="mb-2">Nomor Material <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nomor_material" name="nomor_material"
                                        required value="{{ $product->nomor_material }}">
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_barang" class="mb-2">Kode Barang <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" required value="{{ $product->kode_barang }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name" class="mb-2">Nama Produk <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required value="{{ $product->nama_barang }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category" class="mb-2">Category <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category" name="category" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="unit" class="mb-2">Satuan <span class="text-danger">*</span></label>
                                    <select class="form-control" id="unit" name="unit" required>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="price" class="mb-2">Harga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="price" name="price" required value="{{ $product->harga }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="stock_awal" class="mb-2">Stock Awal <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="stock_awal" name="stock_awal" required value="{{ $product->stock_awal }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="stock_minimal" class="mb-2">Stock Minimal <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="stock_minimal" name="stock_minimal"
                                        required value="{{ $product->stock_minimal }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="keterangan" class="mb-2">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $product->keterangan }}</textarea>
                                </div>  
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection