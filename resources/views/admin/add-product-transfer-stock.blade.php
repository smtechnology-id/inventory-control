@extends('layouts.app')

@section('active_report', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Add product Untuk Transfer Stock</h1>
                <p>Add new product for transfer stock</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nomor DO</td>
                                    <td>:</td>
                                    <td>{{ $transfer->nomor_do }}/StockoutCMT-ELN/X/2024</td>
                                </tr>
                                <tr>
                                    <td>Via</td>
                                    <td>:</td>
                                    <td>{{ $transfer->via }}</td>
                                </tr>
                                <tr>
                                    <td>Carrier</td>
                                    <td>:</td>
                                    <td>{{ $transfer->carrier }}</td>
                                </tr>
                                <tr>
                                    <td>Reff</td>
                                    <td>:</td>
                                    <td>{{ $transfer->refrensi }}</td>
                                </tr>
                                <tr>
                                    <td>Truck Number</td>
                                    <td>:</td>
                                    <td>{{ $transfer->truck_number }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Delivered By</td>
                                    <td>:</td>
                                    <td>{{ $transfer->delivered_by }}</td>
                                </tr>
                                <tr>
                                    <td>Attendant</td>
                                    <td>:</td>
                                    <td>{{ $transfer->attendant }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td>{{ $transfer->keterangan }}</td>
                                </tr>
                                <tr>
                                    <td>Refrensi</td>
                                    <td>:</td>
                                    <td>{{ $transfer->refrensi }}</td>
                                </tr>
                                <tr>
                                    <td>Lokasi Kirim</td>
                                    <td>:</td>
                                    <td>{{ $transfer->lokasi_kirim }}</td>
                                </tr>
                                <tr>
                                    <td>Delivered By</td>
                                    <td>:</td>
                                    <td>{{ $transfer->delivered_by }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Konsumen --}}

        </table>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Produk
                    </button>
                    {{-- Download  PDF --}}
                    <a href="{{ route('admin.cetak.transfer.stock.pdf', $transfer->nomor_do) }}"
                        class="btn btn-primary" style="background-color: #D31517; border-color: #D31517;">Cetak
                        PDF</a>
                    {{-- <a href="{{ route('admin.cetak.transfer.stock.excel', $transfer->nomor_do) }}"
                        class="btn btn-primary" style="background-color: #28a745; border-color: #28a745;">Cetak
                        Surat Jalan (Excel)</a> --}}

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.store.transfer.stock.product') }}" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @csrf
                                        <input type="hidden" name="nomor_do" value="{{ $transfer->nomor_do }}">
                                        <div class="form-group">
                                            <label for="product_gudang_awal_id">Product Gudang Awal</label>
                                            <select name="product_gudang_awal_id" id="product_gudang_awal_id"
                                                class="form-control" required>
                                                <option value="">Pilih Product</option>
                                                @foreach ($productGudangAwal as $productAwal)
                                                    <option value="{{ $productAwal->id }}">
                                                        {{ $productAwal->nama_barang }} -
                                                        {{ $productAwal->gudang->name }} - {{ $productAwal->stock }}
                                                        {{ $productAwal->unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_gudang_tujuan_id">Product Gudang Tujuan</label>
                                            <select name="product_gudang_tujuan_id" id="product_gudang_tujuan_id"
                                                class="form-control" required>
                                                <option value="">Pilih Product</option>
                                                @foreach ($productGudangTujuan as $productTujuan)
                                                    <option value="{{ $productTujuan->id }}">
                                                        {{ $productTujuan->nama_barang }} -
                                                        {{ $productTujuan->gudang->name }} -
                                                        {{ $productTujuan->stock }}
                                                        {{ $productTujuan->unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="transfer_stock_id" value="{{ $transfer->id }}">

                                        <div class="form-group">
                                            <label for="qty">Qty</label>
                                            <input type="number" name="qty" id="qty" class="form-control" required>
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
                                    </div>
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
                                <th>{{ $transfer->gudangAwal->name }}</th>
                                <th>{{ $transfer->gudangTujuan->name }}</th>
                                <th>Qty</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transferProducts as $transferProduct)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $transferProduct->productGudangAwal->kode_barang }} -
                                        {{ $transferProduct->productGudangAwal->nama_barang }}</td>
                                    <td>{{ $transferProduct->productGudangTujuan->kode_barang }} -
                                        {{ $transferProduct->productGudangTujuan->nama_barang }}</td>
                                    <td>{{ $transferProduct->qty }}</td>
                                    <td>{{ $transferProduct->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('admin.delete.product.transfer.stock', $transferProduct->id) }}"
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
