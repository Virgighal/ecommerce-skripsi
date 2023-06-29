@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                <h1>Orders Management</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Order</li>
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
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>User Name</th>
                                <th>Status</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ number_format($order->total_price, 2) }}</td>
                                    <td style="white-space: nowrap;">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.orders.show', [$order->id]) }}">
                                            <i class="fas fa-folder"></i> Update Status
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <nav class="pull-right mt-3 mr-3">
                    {{ $orders->appends($_GET)->links() }}
                </nav>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection