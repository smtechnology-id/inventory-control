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
                        <div class="col-12">
                            {{-- Filtering By Created At --}}
                            <form action="{{ route('admin.report.history.masuk.filter') }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <label for="created_at">From</label>
                                        <input type="date" name="from" class="form-control"
                                            value="{{ request('created_at') }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="created_at">To</label>
                                        <input type="date" name="to" class="form-control"
                                            value="{{ request('created_at') }}">
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary"
                                            onclick="openFilter()">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor PO</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Gudang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Keterangan</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $report->nomor_po }}</td>
                                            <td>{{ $report->product->kode_barang }}</td>
                                            <td>{{ $report->product->nama_barang }} </td>
                                            <td>{{ $report->product->gudang->name }}</td>
                                            <td>{{ $report->quantity }} {{ $report->product->unit->name }}</td>
                                            <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                                            <td>{{ $report->keterangan }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $report->id }}">
                                                    Detail
                                                </button>
                                                <a href="{{ route('admin.report.masuk.edit', $report->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $report->id }}">
                                                    Delete
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal{{ $report->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Delete Report
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus report ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <a href="{{ route('admin.report.masuk.delete', $report->id) }}"
                                                                    class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="detailModal{{ $report->id }}" tabindex="-1"
                                                    aria-labelledby="detailModalLabel" aria-hidden="true">
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
                                                                            <td>{{ $report->product->nama_barang }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Gudang</th>
                                                                            <td>{{ $report->product->gudang->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jumlah</th>
                                                                            <td>{{ $report->quantity }} {{ $report->product->unit->name }}</td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <th>Tanggal Masuk</th>
                                                                            <td>{{ $report->created_at->format('d-m-Y H:i') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Keterangan</th>
                                                                            <td>{{ $report->keterangan }}</td>
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

@section('script')
    <script>
        function openFilter() {
            const form = document.querySelector('form');
            const action = form.getAttribute('action');
            const from = form.querySelector('input[name="from"]').value;
            const to = form.querySelector('input[name="to"]').value;

            const url = `${action}?from=${from}&to=${to}`;
            window.open(url, '_blank');
        }
    </script>
@endsection
