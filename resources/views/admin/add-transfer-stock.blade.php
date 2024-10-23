@extends('layouts.app')

@section('active_addReport', 'active-page')
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Transfer Barang</h1>
                <p>Transfer barang dari gudang lama ke gudang baru</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Transfer Barang</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.transfer.stock.store') }}" method="post">
                        @csrf
                        
                        <div class="row align-items-center">
                            <div class="col-5">
                                <div class="mb-3">
                                    <label for="gudang_awal" class="form-label">Pilih Gudang Awal</label>
                                    <select name="gudang_awal" id="gudang_awal" class="form-select" required>
                                        @foreach ($gudangs as $gudang)
                                            <option value="{{ $gudang->id }}">{{ $gudang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center">
                               <label for="">Ke</label>
                               <i class="material-icons">arrow_right</i>
                            </div>
                            <div class="col-5">
                                <div class="mb-3">
                                    <label for="gudang_tujuan" class="form-label">Pilih Gudang Tujuan</label>
                                    <select name="gudang_tujuan" id="gudang_tujuan" class="form-select" required>
                                        @foreach ($gudangs as $gudang)
                                            <option value="{{ $gudang->id }}">{{ $gudang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="attendant" class="form-label">Attendant</label>
                                    <input type="text" name="attendant" id="attendant" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="via" class="form-label">Via</label>
                                    <input type="text" name="via" id="via" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="carrier" class="form-label">Carrier</label>
                                    <input type="text" name="carrier" id="carrier" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="refrensi" class="form-label">Refrensi</label>
                                    <input type="text" name="refrensi" id="refrensi" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="delivered_by" class="form-label">Delivered By</label>
                                    <input type="text" name="delivered_by" id="delivered_by" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="truck_number" class="form-label">Truck Number</label>
                                    <input type="text" name="truck_number" id="truck_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="lokasi_kirim" class="form-label">Lokasi Kirim</label>
                                    <input type="text" name="lokasi_kirim" id="lokasi_kirim" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#gudang_awal').select2({

            });
        });

        $(document).ready(function() {
            $('#gudang_tujuan').select2({

            });
        });

        $(document).ready(function() {
            $('#gudang_awal').select2({

            });
        });
    </script>
@endsection
