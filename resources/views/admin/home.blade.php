@extends('admin.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                    <h1>Laporan Penjualan Dan Komplain</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div style=" display:flex">
                <div class="col-4">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                {{ \App\Models\Order::where('status', 'Selesai Pengirimans')->count() }}
                            </h3>
                            <p>Total Transaction</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                Rp. {{ number_format(\App\Models\Order::where('status', 'Selesai Pengirimans')->sum('total_price')) }}
                            </h3>
                            <p>Total Sales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                            <th>User Name</th>
                            <th>Complain</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->username }}</td>
                                <td>{{ $comment->text }}</td>
                                <td>
                                    @if(auth()->user()->id != $comment->user_id)
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.comments.show', [$comment->order_id]) }}">
                                            <i class="fas fa-comment"></i> Show
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav class="pull-right mt-3 mr-3">
                {{ $comments->appends($_GET)->links() }}
            </nav>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
