@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                <h1>Ratings</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Ratings</li>
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
                    <p>
                        Search
                    </p>
                    <form action="{{ route('admin.ratings.index') }}" method="GET">
                        <div style="display: flex;gap:20px">
                            <div style="width: 30%">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Enter Name">
                            </div>
                            <div style="width: 30%">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" autocomplete="off" name="email" placeholder="Enter Email">
                            </div>
                            <div style="width: 30%">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="product_name" placeholder="Enter Product Name">
                            </div>
                            <div style="width: 20%">
                                <button type="submit" class="btn btn-primary" style="margin-top:30px">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ratings as $rating)
                                <tr>
                                    <td>{{!empty($rating->user) ? $rating->user->name : 'N/A' }}</td>
                                    <td>{{!empty($rating->user) ? $rating->user->email : 'N/A' }}</td>
                                    <td>{{ !empty($rating->product) ? $rating->product->name : 'N/A' }}</td>
                                    @if(!empty($rating->product))
                                        <td><img src="{{ url($rating->product->image_file_path) }}" alt="" style="width: 50px;height:50px"></td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    <td>
                                        <style>
                                            .checked {
                                                color: orange;
                                            }
                                        </style>
                                        @php
                                            for($i = 1; $i <= $rating->rating; $i++) {
                                                echo "<span class='fa fa-star checked' style=font-size:15px'></span>";
                                            }

                                            if($rating->rating < 5) {
                                                for($i = 1; $i <= (5 - $rating->rating); $i++) {
                                                    echo "<span class='fa fa-star' style=font-size:15px'></span>";
                                                }
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <nav class="pull-right mt-3 mr-3">
                    {!! $ratings->appends($_GET)->links() !!}
                </nav>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection