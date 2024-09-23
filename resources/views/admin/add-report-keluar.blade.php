@extends('layouts.app')

@section('active_report', 'active-page')
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Laporan Barang Keluar</h1>
                <p>Buat laporan barang keluar</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Laporan Barang Keluar</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.report.keluar.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="stock_id" class="mb-2">Stock <span class="text-danger">*</span></label>
                                    <select name="stock_id" id="stock_id" class="form-control select2" required>
                                        <option value="">Pilih Stock</option>
                                        @foreach ($stocks as $stock)
                                            <option value="{{ $stock->id }}">{{ $stock->name }} -
                                                {{ $stock->nomor_polisi_kendaraan }} - {{ $stock->nomor_hp_driver }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="driver_id" class="mb-2">Driver <span class="text-danger">*</span></label>
                                    <select name="driver_id" id="driver_id" class="form-control js-example-basic-single" required>
                                        <option value="">Pilih Driver</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->nama_driver }} -
                                                {{ $driver->nomor_polisi_kendaraan }} - {{ $driver->nomor_hp_driver }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="konsumen_id" class="mb-2">Konsumen <span
                                            class="text-danger">*</span></label>
                                    <select name="konsumen_id" id="konsumen_id" class="form-control select2" required>
                                        <option value="">Pilih Konsumen</option>
                                        @foreach ($konsumens as $konsumen)
                                            <option value="{{ $konsumen->id }}">{{ $konsumen->name }} -
                                                {{ $konsumen->nomor_telepon }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nomor_do" class="mb-2">Nomor DO <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_do" id="nomor_do" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="quantity" class="mb-2">Quantity <span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="keterangan" class="mb-2">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#driver_id').select2({

            });
        });

        $(document).ready(function() {
            $('#stock_id').select2({

            });
        });

        $(document).ready(function() {
            $('#supplier_id').select2({

            });
        });
        $(document).ready(function() {
            $('#konsumen_id').select2({

            });
        });
    </script>
@endsection
