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
                    <div class="col-12">
                        {{-- Filtering By Created At --}}
                        <form action="{{ route('supervisor.report.history.keluar.filter') }}" method="get">
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
                                    <button type="button" class="btn btn-primary" onclick="openFilter()">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <a href="{{ route('supervisor.report.history.keluar.download.excel', ['from' => request('from'), 'to' => request('to')]) }}" class="btn btn-success">Export</a>
                        <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Gudang</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Keluar</th>
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