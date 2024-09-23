@extends('layouts.app')

@section('active_konsumen', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Konsumen</h1>
                <p>List of konsumen</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Konsumen</h3>
                </div>
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Konsumen
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.konsumen.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Konsumen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="nama_konsumen">Nama Konsumen</label>
                                            <input type="text" class="form-control" id="nama_konsumen" name="nama_konsumen"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nomor_hp_konsumen">Nomor HP Konsumen</label>
                                            <input type="text" class="form-control" id="nomor_hp_konsumen" name="nomor_hp_konsumen"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="alamat_konsumen">Alamat Konsumen</label>
                                            <input type="text" class="form-control" id="alamat_konsumen" name="alamat_konsumen"
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
                                    <th>Nomor HP Konsumen</th>
                                    <th>Alamat Konsumen</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($konsumens as $konsumen)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $konsumen->name }}</td>
                                        <td>{{ $konsumen->nomor_telepon }}</td>
                                        <td>{{ $konsumen->alamat }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $konsumen->id }}">
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal{{ $konsumen->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.konsumen.update') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Edit Konsumen
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="hidden" name="id" value="{{ $konsumen->id }}">
                                                                    <input type="text" class="form-control"
                                                                        id="nama_konsumen" name="nama_konsumen" value="{{ $konsumen->name }}" required>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="nomor_hp_konsumen">Nomor HP Konsumen</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nomor_hp_konsumen" name="nomor_hp_konsumen" value="{{ $konsumen->nomor_telepon }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="alamat_konsumen">Alamat Konsumen</label>
                                                                    <input type="text" class="form-control"
                                                                        id="alamat_konsumen" name="alamat_konsumen" value="{{ $konsumen->alamat }}" required>
                                                                </div>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('admin.konsumen.delete', $konsumen->slug) }}"
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
    </div>
@endsection
