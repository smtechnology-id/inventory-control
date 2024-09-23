@extends('layouts.app')

@section('active_account', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Account Staff</h1>
                <p>List of account staff</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Account Staff</h3>
                </div>
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <a class="btn btn-primary mb-3" href="{{ route('admin.account.add') }}">Add Account Staff</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ $account->level }}</td>
                                        <td>
                                            <a href="{{ route('admin.account.edit', $account->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ route('admin.account.delete', $account->id) }}"
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
