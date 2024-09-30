@extends('layouts.app')

@section('active_report', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Stock Opname</h1>
                <p>List of stock opname</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Stock Opname Gudang</h3>
                </div>
                <div class="card-body">
                   <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Nomor Material</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Gudang</th>
                                    <th>Stock Tercatat</th>
                                    <th>Stock Aktual</th>
                                    <th>Selisih</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stockOpnames as $stockOpname)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stockOpname->stock->product->nama_barang }}</td>
                                        <td>{{ $stockOpname->stock->product->nomor_material }}</td>
                                        <td>{{ $stockOpname->stock->product->kode_barang }}</td>
                                        <td>{{ $stockOpname->stock->gudang->name }}</td>
                                        <td>{{ $stockOpname->stock_tercatat }}</td>
                                        <td>{{ $stockOpname->jumlah_aktual }}</td>
                                        <td>{{ $stockOpname->stock_tercatat - $stockOpname->jumlah_aktual }}</td>
                                        <td>{{ $stockOpname->keterangan }}</td>
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
