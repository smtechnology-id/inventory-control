@extends('layouts.app')

@section('active_report', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Add product Untuk Surat Jalan</h1>
                <p>Add new product for surat jalan</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('supervisor.cetak.surat.jalan.excel', $suratJalan->kode) }}" class="btn btn-primary"
                        style="background-color: #28a745; border-color: #28a745;">Cetak
                        Surat Jalan (Excel)</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Keterangan</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productSuratJalans as $suratJalanProduct)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $suratJalanProduct->stock->product->kode_barang }}</td>
                                    <td>{{ $suratJalanProduct->stock->product->nama_barang }}</td>
                                    <td>{{ $suratJalanProduct->qty }}</td>
                                    <td>{{ $suratJalanProduct->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
@endsection
