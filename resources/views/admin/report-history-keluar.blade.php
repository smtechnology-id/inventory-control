@extends('layouts.app')

@section('active_report', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>History Report Barang Keluar</h1>
                <p>List of report barang keluar</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>History Report Barang Keluar</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nomor DO</th>
                                        <th>Konsumen</th>
                                        <th>Via</th>
                                        <th>Carrier</th>
                                        <th>Reff</th>
                                        <th>Truck Number</th>
                                        <th>Delivered By</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $report->kode }}</td>
                                            <td>{{ $report->nomor_do }}/StockoutCMT-ELN/X/2024</td>
                                            <td>{{ $report->konsumen->name ?? '-' }}</td>
                                            <td>{{ $report->via }}</td>
                                            <td>{{ $report->carrier }}</td>
                                            <td>{{ $report->reff }}</td>
                                            <td>{{ $report->truck_number }}</td>
                                            <td>{{ $report->delivered_by }}</td>
                                            <td>
                                                <a href="{{ route('admin.add.product.surat.jalan', $report->kode) }}" class="btn btn-primary">Detail</a>
                                                <a href="{{ route('admin.cetak.surat.jalan.excel', $report->kode) }}" class="btn btn-success">Cetak Excel</a>
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
