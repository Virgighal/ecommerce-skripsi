@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-6">
                        <h1>Edit user</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            @if(Session::has('success_message'))
                <div class="alert alert-success" role="alert">
                {{ Session::get('success_message') }}
                </div>
            @endif

            @if(Session::has('error_message'))
                <div class="alert alert-danger" role="alert">
                {{ Session::get('error_message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit User</h3>
                        </div>
                        <form action="{{ route('admin.users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                                            value="{{ $user->name }}">
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control @if ($errors->has('email')) is-invalid @endif"
                                            value="{{ $user->email }}">
                                        @error('email')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="phone">Phone Number</label>
                                        <input type="phone" name="phone_number" id="phone_number"
                                            class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                            value="{{ $user->phone_number }}">
                                        @error('phone_number')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" id="" cols="30" rows="10">{{ $user->address }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control @if ($errors->has('password')) is-invalid @endif"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        <input type="password_confirmation" name="password_confirmation" id="password_confirmation"
                                            class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                            value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <input type="submit" value="Update User" class="btn btn-success float-right">
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection