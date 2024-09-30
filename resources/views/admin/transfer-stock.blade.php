@extends('layouts.app')

@section('active_report', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Transfer Stock</h1>
                <p>List of transfer stock</p>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.transfer.stock.filter') }}" method="get">
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Transfer Stock</h3>
                </div>
                <div class="card-body">
                   
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Kode Barang</th>
                                        <th>Gudang Awal</th>
                                        <th>Gudang Tujuan</th>
                                        <th>Jumlah</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transfers as $transfer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transfer->product->nama_barang }}</td>
                                            <td>{{ $transfer->product->kode_barang }}</td>
                                            <td>{{ $transfer->gudangAwal->name }}</td>
                                            <td>{{ $transfer->gudangTujuan->name }}</td>
                                            <td>{{ $transfer->quantity }}</td>
                                            <td>{{ $transfer->created_at->format('d-m-Y H:i:s') }}</td>
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
        $(document).ready(function() {
            $('#stock_old_id').select2({

            });
        });

        $(document).ready(function() {
            $('#stock_new_id').select2({

            });
        });

    </script>
@endsection
