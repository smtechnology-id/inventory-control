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
                                    <th>Nama Gudang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gudangs as $gudang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $gudang->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.stock.gudang', $gudang->slug) }}" class="btn btn-primary">Lihat Stock Gudang</a>
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
    </div>
@endsection
