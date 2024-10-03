@extends('layouts.app')

@section('active_supplier', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Supplier</h1>
                <p>List of supplier</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Supplier</h3>
                </div>
                <div class="card-body">
                    <!-- Button trigger modal -->
                 

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.supplier.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="nama_supplier">Nama Supplier</label>
                                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nomor_hp_supplier">Nomor HP Supplier</label>
                                            <input type="text" class="form-control" id="nomor_hp_supplier" name="nomor_hp_supplier"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="alamat_supplier">Alamat Supplier</label>
                                            <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier"
                                                required>
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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Supplier</th>
                                    <th>Nomor HP Supplier</th>
                                    <th>Alamat Supplier</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->nomor_telepon }}</td>
                                        <td>{{ $supplier->alamat }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
