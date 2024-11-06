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
                        <td>Attn</td>
                        <td>:</td>
                        <td>{{ $suratJalan->attn }}</td>
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
                        <td>{{ $suratJalan->konsumen->name }} - {{ $suratJalan->konsumen->nomor_telepon }} -
                            {{ $suratJalan->konsumen->alamat }}</td>
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
                <a href="{{ route('admin.cetak.surat.jalan.excel', $suratJalan->kode) }}" class="btn btn-primary" style="background-color: #28a745; border-color: #28a745;">Cetak
                    Surat Jalan (Excel)</a>
                <a href="{{ route('admin.cetak.surat.jalan.pdf', $suratJalan->nomor_do) }}" class="btn btn-primary" style="background-color: #E62C31; border-color: #E62C31;">Cetak
                    Surat Jalan (PDF)</a>
                <!-- Modal -->

            </div>

            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h5>Add Product</h5>
                        <form action="{{ route('admin.store.product.surat.jalan') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="product_id">Product</label>
                                        <select name="product_id" id="product_id" class="form-control select2" required>
                                            <option value="">Pilih Product</option>
                                            @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->nama_barang }} -
                                                {{ $product->gudang->name }} - {{ $product->stock }}
                                                {{ $product->unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <input type="hidden" name="surat_jalan_id" value="{{ $suratJalan->id }}">
            
                                    <div class="form-group">
                                        <label for="qty">Qty</label>
                                        <input type="number" name="qty" id="qty" class="form-control" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="1"></textarea>
                                    </div>
                                </div>
                                <div class="col d-flex flex-column">
                                    <label for="submit">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
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
                                <a href="{{ route('admin.delete.product.surat.jalan', $suratJalanProduct->id) }}" class="btn btn-danger">Delete</a>
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


@section('script')
<script>
    $(document).ready(function() {
        $('#product_id').select2({

        });
    });

</script>
@endsection
