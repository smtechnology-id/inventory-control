@extends('layouts.app')

@section('active_account', 'active-page');
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Account</h1>
                <p>Add new account</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Account</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.account.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="mb-2">Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="level" class="mb-2">Level <span class="text-danger">*</span></label>
                                    <select class="form-control" id="level" name="level" required>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="mb-2">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="mb-2">Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="mb-2">Password Confirmation <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
