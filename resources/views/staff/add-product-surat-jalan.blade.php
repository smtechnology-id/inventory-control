@extends('layouts.app')

@section('active_report', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Add product Untuk Surat Jalan</h1>
                <p>Add new product for surat jalan</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Produk
                    </button>
                    <a href="{{ route('admin.cetak.surat.jalan.excel', $suratJalan->kode) }}" class="btn btn-primary"
                        style="background-color: #28a745; border-color: #28a745;">Cetak
                        Surat Jalan (Excel)</a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.store.product.surat.jalan') }}" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-group">
                                            <label for="product_id">Product</label>
                                            <select name="product_id" id="product_id" class="form-control">
                                                <option value="">Pilih Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="surat_jalan_id" value="{{ $suratJalan->id }}">
                                        <div class="form-group">
                                            <label for="gudang_id">Gudang</label>
                                            <select name="gudang_id" id="gudang_id" class="form-control">
                                                <option value="">Pilih Gudang</option>
                                                @foreach ($gudangs as $gudang)
                                                    <option value="{{ $gudang->id }}">{{ $gudang->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Qty</label>
                                            <input type="number" name="qty" id="qty" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productSuratJalans as $suratJalanProduct)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $suratJalanProduct->stock->product->kode_barang }}</td>
                                    <td>{{ $suratJalanProduct->stock->product->nama_barang }}</td>
                                    <td>{{ $suratJalanProduct->qty }}</td>
                                    <td>{{ $suratJalanProduct->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('admin.delete.product.surat.jalan', $suratJalanProduct->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
@endsection
