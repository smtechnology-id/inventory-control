@extends('layouts.app')

@section('active_stock', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Stock</h1>
                <p>List of stock</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Stock Gudang</h3>
                </div>
                <div class="card-body">
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Material</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Gudang</th>
                                    <th>Stock Minimal</th>
                                    <th>Stock</th>
                                    <th>Keterangan</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->nomor_material }}</td>
                                        <td>{{ $product->kode_barang }}</td>
                                        <td>{{ $product->nama_barang }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->gudang->name }}</td>
                                        <td>{{ $product->stock_minimal }}</td>
                                        <td>{{ $product->stock }} {{ $product->unit->name }}</td>
                                        <td>{{ $product->keterangan }}</td>    
                                        <td>{{ $product->created_at->format('d-m-Y H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
