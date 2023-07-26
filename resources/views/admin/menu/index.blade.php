@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                <h1>Menu</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Menu</li>
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
                        Menu
                    </p>
                    <form action="{{ route('admin.menu.index') }}" method="GET">
                        <div style="display: flex;gap:20px">
                            <div style="width: 30%">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Enter Product Name">
                            </div>
                            <div style="width: 30%">
                                <label for="name">Code</label>
                                <input type="text" class="form-control" autocomplete="off" name="code" placeholder="Enter Product Code">
                            </div>
                            <div style="width:30%">
                                <label for="type">Type</label>
                                <select name="type" class="form-control" id="">
                                    @php
                                        $options = [
                                            [
                                                'label' => 'Makanan',
                                                'value' => 'makanan'
                                            ],
                                            [
                                                'label' => 'Minuman',
                                                'value' => 'minuman'
                                            ]
                                        ]
                                    @endphp
                                    <option value="">Please select Type</option>
                                    @foreach ($options as $option)
                                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="width: 20%">
                                <button type="submit" class="btn btn-primary" style="margin-top:30px">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div style="display: flex;flex-wrap: wrap;gap:30px;padding:20px">
                <style>
                    .checked {
                        color: orange;
                    }
                </style>
                @foreach ($products as $product)
                    <div class="card" style="width: 18rem;display:flex" >
                        <img class="card-img-top" src="{{ url($product->image_file_path) }}" style="height: 200px">
                        <div class="card-body">
                            <p class="card-text">{{ $product->name }}</p>
                            <p class="card-text">{{ $product->code }}</p>
                            <p class="card-text" style="font-size: 20px"><b>Rp. {{ number_format($product->price, 2) }}</b></p>
                            @php
                                for($i = 1; $i <= $product->rating_star; $i++) {
                                    echo "<span class='fa fa-star checked' style=font-size:15px'></span>";
                                }

                                if($product->rating_star < 5) {
                                    for($i = 1; $i <= (5 - $product->rating_star); $i++) {
                                        echo "<span class='fa fa-star' style=font-size:15px'></span>";
                                    }
                                }
                            @endphp
                        </div>
                    </div>
                @endforeach
            </div>

        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection