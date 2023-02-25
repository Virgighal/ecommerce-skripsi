@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                <h1>Users Management</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
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

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mr-2">
                        <a class="btn btn-primary btn-sm" href={{ route('admin.users.create') }}>
                            <i class="fas fa-plus" style="margin-right: 10px"></i>
                            Create New User
                        </a>
                    </h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="white-space: nowrap;">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.users.show', [$user->id]) }}">
                                            <i class="fas fa-folder"></i> View
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0)"
                                            onclick="if(confirm('Are you sure you want to delete this user?')) $('#deleteForm-{{ $user->id}}').submit()">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                        <form action="{{ route('admin.users.destroy', [
                                            $user->id
                                        ]) 
                                            }}" method="POST"
                                            id='deleteForm-{{ $user->id }}'>
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <nav class="pull-right mt-3 mr-3">
                    {{ $users->appends($_GET)->links() }}
                </nav>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection