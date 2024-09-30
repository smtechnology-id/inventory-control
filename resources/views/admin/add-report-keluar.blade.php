@extends('layouts.app')

@section('active_addReport', 'active-page')
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
                                <div class="form-group mb-3">
                                    <label for="driver_id" class="mb-2">Driver <span
                                            class="text-danger">*</span></label>
                                    <select name="driver_id" id="driver_id" class="form-control select2" required>
                                        <option value="">Pilih Driver</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->nama_driver }} -
                                                {{ $driver->nomor_hp_driver }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nomor_do" class="mb-2">Nomor DO <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_do" id="nomor_do" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="via" class="mb-2">Via</label>
                                    <input type="text" name="via" id="via" class="form-control" required>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="carrier" class="mb-2">Carrier</label>
                                    <input type="text" name="carrier" id="carrier" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="reff" class="mb-2">Reff</label>
                                    <input type="text" name="reff" id="reff" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="truck_number" class="mb-2">Truck Number</label>
                                    <input type="text" name="truck_number" id="truck_number" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="delivered_by" class="mb-2">Delivered By</label>
                                    <input type="text" name="delivered_by" id="delivered_by" class="form-control" required>
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
            $('#product_id').select2({

            });
        });

        $(document).ready(function() {
            $('#gudang_id').select2({

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
