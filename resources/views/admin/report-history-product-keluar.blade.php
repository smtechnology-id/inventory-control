@extends('layouts.app')

@section('active_report', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>History Report Keluar</h1>
                <p>List of report keluar</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>History Report Keluar</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            {{-- Filtering By Created At --}}
                            <form action="{{ route('admin.report.history.keluar.filter') }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <label for="created_at">From</label>
                                        <input type="date" name="from" class="form-control"
                                            value="{{ request('created_at') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="created_at">To</label>
                                        <input type="date" name="to" class="form-control"
                                            value="{{ request('created_at') }}" required>
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
                                        <th>Nama Barang</th>
                                        <th>Gudang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $report->stock->product->nama_barang }}</td>
                                            <td>{{ $report->stock->gudang->name }}</td>
                                            <td>{{ $report->qty }}</td>
                                            <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $report->id }}">
                                                    Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{ $report->id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{ $report->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel{{ $report->id }}">Edit Report Keluar
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('admin.report.keluar.update') }}" method="post">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-12 mt-3">
                                                                            <label for="qty">Jumlah</label>
                                                                            <input type="number" name="qty" class="form-control" value="{{ $report->qty }}">
                                                                        </div>
                                                                        <input type="hidden" name="id" value="{{ $report->id }}">
                                                                        <div class="col-12 mt-3">
                                                                            <label for="keterangan">Keterangan</label>
                                                                            <textarea name="keterangan" class="form-control" rows="3">{{ $report->keterangan }}</textarea>
                                                                        </div>
                                                                        <div class="col-12 mt-3">
                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
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
