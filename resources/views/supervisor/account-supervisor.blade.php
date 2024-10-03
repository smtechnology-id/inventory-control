@extends('layouts.app')

@section('active_account', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Account Supervisor</h1>
                <p>List of account supervisor</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Account Supervisor</h3>
                </div>
                <div class="card-body">
                    <!-- Button trigger modal -->
                  
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ $account->level }}</td>
                                       
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
