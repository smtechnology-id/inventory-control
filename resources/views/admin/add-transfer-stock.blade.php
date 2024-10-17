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
                                    <label for="product_id" class="form-label">Pilih Barang</label>
                                    <select name="product_awal" id="product_awal" class="form-select" required>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->nama_barang }} - {{ $product->gudang->name }}</option>
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
                                    <label for="product_tujuan" class="form-label">Pilih Barang</label>
                                    <select name="product_tujuan" id="product_tujuan" class="form-select" required>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->nama_barang }} - {{ $product->gudang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah</label>
                            <input type="number" name="quantity" id="quantity" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="refrensi" class="form-label">Refrensi</label>
                            <input type="text" name="refrensi" id="refrensi" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_kirim" class="form-label">Lokasi Kirim</label>
                            <input type="text" name="lokasi_kirim" id="lokasi_kirim" class="form-control">
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
            $('#product_tujuan').select2({

            });
        });

        $(document).ready(function() {
            $('#product_awal').select2({

            });
        });

        $(document).ready(function() {
            $('#gudang_awal').select2({

            });
        });
    </script>
@endsection
