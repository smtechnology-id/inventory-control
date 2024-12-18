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
                <input type="date" name="from" class="form-control" value="{{ request('created_at') }}">
            </div>
            <div class="col-6">
                <label for="created_at">To</label>
                <input type="date" name="to" class="form-control" value="{{ request('created_at') }}">
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
                                        <th>Nomor DO</th>
                                        <th>Gudang Awal</th>
                                        <th>Gudang Tujuan</th>
                                        <th>Refrensi</th>
                                        <th>Lokasi Kirim</th>
                                        <th>Attendant</th>
                                        <th>Via</th>
                                        <th>Carrier</th>
                                        <th>Truck Number</th>
                                        <th>Delivery By</th>
                                        
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transfers as $transfer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transfer->nomor_do }}/TransferoutCMT-ELN/X/2024</td>
                                            <td>{{ $transfer->gudangAwal->name }}</td>
                                            <td>{{ $transfer->gudangTujuan->name }}</td>
                                            <td>{{ $transfer->refrensi }}</td>
                                            <td>{{ $transfer->lokasi_kirim }}</td>
                                            <td>{{ $transfer->attendant }}</td>
                                            <td>{{ $transfer->via }}</td>
                                            <td>{{ $transfer->carrier }}</td>
                                            <td>{{ $transfer->truck_number }}</td>
                                            <td>{{ $transfer->delivered_by }}</td>
                                            <td>
                                                <a href="{{ route('admin.add-product-transfer-stock', $transfer->nomor_do) }}" class="btn btn-primary">Detail</a>
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
        $(document).ready(function() {
            $('#stock_old_id').select2({

            });
        });

        $(document).ready(function() {
            $('#stock_new_id').select2({

            });
        });

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
