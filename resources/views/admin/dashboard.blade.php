@extends('layouts.app')


@section('active_dashboard', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">paid</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Barang</span>
                            <span class="widget-stats-amount">{{ $totalBarang }}</span>
                            <span class="widget-stats-info">Total Barang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">paid</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Gudang</span>
                            <span class="widget-stats-amount">{{ $gudang }}</span>
                            <span class="widget-stats-info">Total Gudang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">paid</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Supplier</span>
                            <span class="widget-stats-amount">{{ $supplier }}</span>
                            <span class="widget-stats-info">Total Supplier</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">paid</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Konsumen</span>
                            <span class="widget-stats-amount">{{ $konsumen }}</span>
                            <span class="widget-stats-info">Total Konsumen</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">paid</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Driver</span>
                            <span class="widget-stats-amount">{{ $driver }}</span>
                            <span class="widget-stats-info">Total Driver</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">paid</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total User</span>
                            <span class="widget-stats-amount">{{ $user }}</span>
                            <span class="widget-stats-info">Total User</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stock Kritis --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Stock Kritis</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Gudang</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productKritis as $stock)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stock->nama_barang }}</td>
                                        <td>{{ $stock->kode_barang }}</td>
                                        <td>{{ $stock->gudang->name }}</td>
                                        <td>{{ $stock->stock }}</td>
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
    </div>

@endsection
