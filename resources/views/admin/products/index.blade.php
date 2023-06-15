@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                <h1>Products Management</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
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
                        Search Product
                    </p>
                    <form action="{{ route('admin.products.index') }}" method="GET">
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

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mr-2">
                        <a class="btn btn-primary btn-sm" href={{ route('admin.products.create') }}>
                            <i class="fas fa-plus" style="margin-right: 10px"></i>
                            Create New Product
                        </a>
                    </h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->type }}</td>
                                    <td>{{ number_format($product->price, 2) }}</td>
                                    <td style="white-space: nowrap;">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.products.show', [$product->id]) }}">
                                            <i class="fas fa-folder"></i> View
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0)"
                                            onclick="if(confirm('Are you sure you want to delete this Product data?')) $('#deleteForm-{{ $product->id}}').submit()">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                        <form action="{{ route('admin.products.destroy', [
                                            $product->id
                                        ]) 
                                            }}" method="POST"
                                            id='deleteForm-{{ $product->id }}'>
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <nav class="pull-right mt-3 mr-3">
                    {!! $products->appends($_GET)->links() !!}
                </nav>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection