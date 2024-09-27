@extends('layouts.app')

@section('active_report', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>History Report Masuk</h1>
                <p>List of report masuk</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>History Report Masuk</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor PO</th>
                                        <th>Nama Barang</th>
                                        <th>Gudang</th>
                                        <th>Jumlah</th>
                                        <th>Nama Supplier</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $report->nomor_po }}</td>
                                            <td>{{ $report->stock->product->nama_barang }}</td>
                                            <td>{{ $report->stock->gudang->name }}</td>
                                            <td>{{ $report->quantity }}</td>
                                            <td>{{ $report->supplier->name }}</td>
                                            <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $report->id }}">
                                                    Detail
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="detailModal{{ $report->id }}"
                                                    tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="detailModalLabel">Detail
                                                                    Report Masuk
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Nomor PO</th>
                                                                            <td>{{ $report->nomor_po }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Nama Barang</th>
                                                                            <td>{{ $report->stock->product->nama_barang }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Gudang</th>
                                                                            <td>{{ $report->stock->gudang->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jumlah</th>
                                                                            <td>{{ $report->quantity }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Nama Supplier</th>
                                                                            <td>{{ $report->supplier->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Tanggal Masuk</th>
                                                                            <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Keterangan</th>
                                                                            <td>{{ $report->keterangan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Download File</th>
                                                                            <td>
                                                                                <a target="_blank"
                                                                                    href="{{ asset('storage/' . $report->file) }}"
                                                                                    class="btn btn-primary btn-sm"
                                                                                    style="background-color: #28a745; color: white;">Excel</a>
                                                                                <a target="_blank"
                                                                                    href="{{ asset('storage/' . $report->file) }}"
                                                                                    class="btn btn-primary btn-sm"
                                                                                    style="background-color: #007bff; color: white;">PDF</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
