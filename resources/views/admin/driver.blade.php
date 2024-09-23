@extends('layouts.app')

@section('active_driver', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Driver</h1>
                <p>List of driver</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Driver</h3>
                </div>
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Driver
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.driver.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Driver</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="nama_driver">Nama Driver</label>
                                            <input type="text" class="form-control" id="nama_driver" name="nama_driver"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nomor_hp_driver">Nomor HP Driver</label>
                                            <input type="text" class="form-control" id="nomor_hp_driver" name="nomor_hp_driver"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nomor_polisi_kendaraan">Nomor Polisi Kendaraan</label>
                                            <input type="text" class="form-control" id="nomor_polisi_kendaraan" name="nomor_polisi_kendaraan"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan"
                                                required rows="3"></textarea>
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
                                    <th>Nama Driver</th>
                                    <th>Nomor HP Driver</th>
                                    <th>Nomor Polisi Kendaraan</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drivers as $driver)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $driver->nama_driver }}</td>
                                        <td>{{ $driver->nomor_hp_driver }}</td>
                                        <td>{{ $driver->nomor_polisi_kendaraan }}</td>
                                        <td>{{ $driver->keterangan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $driver->id }}">
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal{{ $driver->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.driver.update') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Edit Gudang
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="hidden" name="id" value="{{ $driver->id }}">
                                                                    <input type="text" class="form-control"
                                                                        id="nama_driver" name="nama_driver" value="{{ $driver->nama_driver }}" required>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="nomor_hp_driver">Nomor HP Driver</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nomor_hp_driver" name="nomor_hp_driver" value="{{ $driver->nomor_hp_driver }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nomor_polisi_kendaraan">Nomor Polisi Kendaraan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nomor_polisi_kendaraan" name="nomor_polisi_kendaraan" value="{{ $driver->nomor_polisi_kendaraan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="keterangan">Keterangan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="keterangan" name="keterangan" value="{{ $driver->keterangan }}" required>
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
                                            <a href="{{ route('admin.driver.delete', $driver->id) }}"
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
