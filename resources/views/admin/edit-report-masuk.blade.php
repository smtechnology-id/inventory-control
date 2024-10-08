@extends('layouts.app')

@section('active_addReport', 'active-page')
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Laporan Barang Masuk</h1>
                <p>Edit laporan barang masuk</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Laporan Barang Masuk</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.report.masuk.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_id" class="mb-2">Product <span class="text-danger">*</span></label>
                                    <select name="product_id" id="product_id" class="form-control select2" required>
                                        <option value="">Pilih Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ $report->stock->product_id == $product->id ? 'selected' : '' }}>{{ $product->nama_barang }} -
                                                {{ $product->kode_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="{{ $report->id }}">
                                <div class="form-group mb-3">
                                    <label for="gudang_id" class="mb-2">Gudang <span class="text-danger">*</span></label>
                                    <select name="gudang_id" id="gudang_id" class="form-control select2" required>
                                        <option value="">Pilih Gudang</option>
                                        @foreach ($gudangs as $gudang)
                                            <option value="{{ $gudang->id }}" {{ $report->stock->gudang_id == $gudang->id ? 'selected' : '' }}>{{ $gudang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                                <div class="form-group mb-3">
                                    <label for="supplier_id" class="mb-2">Supplier <span
                                            class="text-danger">*</span></label>
                                    <select name="supplier_id" id="supplier_id" class="form-control select2" required>
                                        <option value="">Pilih Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ $report->stock->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }} -
                                                {{ $supplier->nomor_telepon }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nomor_po" class="mb-2">Nomor PO <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_po" id="nomor_po" class="form-control" value="{{ $report->nomor_po }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="quantity" class="mb-2">Quantity <span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $report->quantity }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="keterangan" class="mb-2">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $report->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form> <!-- Penutup form ditambahkan di sini -->
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
    </script>
@endsection
