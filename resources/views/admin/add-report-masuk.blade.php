@extends('layouts.app')

@section('active_addReport', 'active-page')
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Laporan Barang Masuk</h1>
                <p>Buat laporan barang masuk</p>
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
                    <form action="{{ route('admin.report.masuk.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_id" class="mb-2">Product <span class="text-danger">*</span></label>
                                    <select name="product_id" id="product_id" class="form-control select2" required>
                                        <option value="">Pilih Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->kode_barang }} - {{ $product->nama_barang }} - {{ $product->gudang->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nomor_po" class="mb-2">Nomor PO <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_po" id="nomor_po" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="quantity" class="mb-2">Quantity <span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" step="0.01" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="keterangan" class="mb-2">Keterangan</label>
                                    <textarea name="keterangan" required id="keterangan" class="form-control" rows="3"></textarea>
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
