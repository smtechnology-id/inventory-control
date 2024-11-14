@extends('layouts.app')

@section('active_report', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Stock Opname</h1>
                <p>List of stock opname</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.stock.opname.filter') }}" method="get">
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
            <a href="{{ route('admin.stock.opname.download.excel', ['from' => request('from'), 'to' => request('to')]) }}" class="btn btn-success">Export</a>
            <div class="card">
                <div class="card-header">
                    <h3>Stock Opname Gudang</h3>
                </div>
                <div class="card-body">
                   <div class="row">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Nomor Material</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Gudang</th>
                                    <th>Stock Tercatat</th>
                                    <th>Stock Aktual</th>
                                    <th>Selisih</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stockOpnames as $stockOpname)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stockOpname->product->nama_barang }}</td>
                                        <td>{{ $stockOpname->product->nomor_material }}</td>
                                        <td>{{ $stockOpname->product->kode_barang }}</td>
                                        <td>{{ $stockOpname->product->nama_barang }}</td>
                                        <td>{{ $stockOpname->product->gudang->name }}</td>
                                        <td>{{ $stockOpname->stock_tercatat }}</td>
                                        <td>{{ $stockOpname->jumlah_aktual }}</td>
                                        <td>{{ $stockOpname->stock_tercatat - $stockOpname->jumlah_aktual }}</td>
                                        <td>{{ $stockOpname->keterangan }}</td>
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

