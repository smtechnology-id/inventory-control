@extends('layouts.app')

@section('active_product', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Product</h1>
                <p>List of product</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Product</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.product-add') }}" class="btn btn-primary mb-3">Add Product</a>
                    <a href="{{ route('admin.product.download.filter', ['gudang' => $gudangSelected->id]) }}" class="btn btn-success mb-3"><i class="bi bi-file-earmark-spreadsheet"></i> Cetak Laporan Gudang {{ $gudangSelected->name }}</a>
                    <form action="{{ route('admin.product.filter') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-3">
                                <select name="gudang" class="form-control" onchange="this.form.submit()">
                                    <option value="">Pilih Gudang</option>
                                    @foreach ($gudangs as $gudang)
                                        <option value="{{ $gudang->id }}" {{ $gudang->id == $gudangSelected->id ? 'selected' : '' }}>{{ $gudang->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-6">
                               
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Material</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Gudang</th>
                                    <th>Satuan</th>
                                    <th>Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Stock Minimal</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->nomor_material }}</td>
                                        <td>{{ $product->kode_barang }}</td>
                                        <td>{{ $product->nama_barang }}</td>
                                        <td>{{ $product->gudang->name }}</td>
                                        <td>{{ $product->unit->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->keterangan }}</td>
                                        <td>{{ $product->stock_minimal }}</td>
                                        <td>{{ $product->stock }} {{ $product->unit->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.product.edit', $product->slug) }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="{{ route('admin.product.delete', $product->slug) }}"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
