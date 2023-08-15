@extends('admin.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                    <h1>Laporan Penjualan & Complain</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
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
            <div class="col-sm-12 col-md-6" style="padding:20px">
                <h4>Laporan Penjualan</h4>
            </div>
            <form action="{{ route('admin.home') }}" method="GET"  id="reportForm" style="padding:20px">
                <div style="display: flex;gap:20px">
                    <div style="width: 30%">
                        <label for="transaction_number">Transaction Number</label>
                        <input type="text" class="form-control" autocomplete="off" name="transaction_number" placeholder="Transaction Number">
                    </div>
                    <div style="width: 30%">
                        <label for="start_date">Start Date</label>
                        <input type="text" class="form-control datepicker" autocomplete="off" name="start_date" placeholder="Enter Start Date">
                    </div>
                    <div style="width: 30%">
                        <label for="end_date">End Date</label>
                        <input type="text" class="form-control datepicker" autocomplete="off" name="end_date" placeholder="Enter End Date">
                    </div>
                    <div style="width: 30%">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" autocomplete="off" name="product_name" placeholder="Enter Product Name">
                    </div>
                </div>
                <div style="width: 20%">
                    <button type="submit" class="btn btn-primary" style="margin-top:30px">Filter</button>
                </div>
            </form>
            <hr>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            @foreach ($datas['header'] as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas['content'] as $content)
                            <tr>
                                @foreach ($content as $item)
                                    <th>{{ $item }}</th> 
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                        <tr>
                            @foreach ($datas['footer_1'] as $footer)
                                <th>{{ $footer }}</th>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>

    <hr>

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
            <div class="col-sm-12 col-md-6" style="padding: 20px">
                <h4>Komplain</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Complain</th>
                            <th>Order Number</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->username }}</td>
                                <td>{{ $comment->text }}</td>
                                <td>{{ $comment->order_number }}</td>
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
