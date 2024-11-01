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
                    <table class="table table-bordered">
                        <tr>
                            <td>Kode Surat Jalan</td>
                            <td>:</td>
                            <td>{{ $suratJalan->kode }}</td>
                        </tr>
                        <tr>
                            <td>Nomor DO</td>
                            <td>:</td>
                            <td>{{ $suratJalan->nomor_do }}/StockoutCMT-ELN/X/2024</td>
                        </tr>
                        <tr>
                            <td>Via</td>
                            <td>:</td>
                            <td>{{ $suratJalan->via }}</td>
                        </tr>
                        <tr>
                            <td>Carrier</td>
                            <td>:</td>
                            <td>{{ $suratJalan->carrier }}</td>
                        </tr>
                        <tr>
                            <td>Reff</td>
                            <td>:</td>
                            <td>{{ $suratJalan->reff }}</td>
                        </tr>
                        <tr>
                            <td>Truck Number</td>
                            <td>:</td>
                            <td>{{ $suratJalan->truck_number }}</td>
                        </tr>
                        <tr>
                            <td>Delivered By</td>
                            <td>:</td>
                            <td>{{ $suratJalan->delivered_by }}</td>
                        </tr>
                        {{-- Konsumen --}}
                        <tr>
                            <td>Konsumen</td>
                            <td>:</td>
                            <td>{{ $suratJalan->konsumen->name }} - {{ $suratJalan->konsumen->nomor_telepon }} - {{ $suratJalan->konsumen->alamat }}</td>
                        </tr>
                    </table>
                </div>
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
                    <a href="{{ route('admin.cetak.surat.jalan.pdf', $suratJalan->nomor_do) }}" class="btn btn-primary"
                        style="background-color: #E62C31; border-color: #E62C31;">Cetak
                        Surat Jalan (PDF)</a>
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
                                                    <option value="{{ $product->id }}">{{ $product->nama_barang }} - {{ $product->gudang->name }} - {{ $product->stock }} {{ $product->unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="surat_jalan_id" value="{{ $suratJalan->id }}">
                                       
                                        <div class="form-group">
                                            <label for="qty">Qty</label>
                                            <input type="number" name="qty" id="qty" class="form-control" step="0.01">
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
                                <th>Nomor Material</th>
                                <th>Product</th>
                                <th>Gudang</th>
                                <th>Qty</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productSuratJalans as $suratJalanProduct)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $suratJalanProduct->product->kode_barang }}</td>
                                    <td>{{ $suratJalanProduct->product->nomor_material }}</td>
                                    <td>{{ $suratJalanProduct->product->nama_barang }}</td>
                                    <td>{{ $suratJalanProduct->product->gudang->name }}</td>
                                    <td>{{ $suratJalanProduct->qty }} {{ $suratJalanProduct->product->unit->name }}</td>
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
