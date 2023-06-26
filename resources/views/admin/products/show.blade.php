@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-6">
                        <h1>Edit Stock</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Stock</li>
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
                            <h3 class="card-title">Edit Stock</h3>
                        </div>
                        <form action="{{ route('admin.products.update', [ $product->id ]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="code">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                                            value="{{ $product->name }}">
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="code">Code</label>
                                        <input type="text" name="code" id="code"
                                            class="form-control @if ($errors->has('code')) is-invalid @endif"
                                            value="{{ $product->code }}">
                                        @error('code')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="type">Type</label>
                                        <select name="type" id="type" class="selectpicker">
                                            <option value="">Please Select</option>
                                            <option value="makanan" @if($product->type == 'makanan') selected @endif>Makanan</option>
                                            <option value="minuman" @if($product->type == 'minuman') selected @endif>Minuman</option>
                                        </select>
                                        @error('currency')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price"
                                            class="form-control @if ($errors->has('price')) is-invalid @endif"
                                            value="{{ $product->price }}">
                                        @error('price')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="image">Product Image</label>
                                        <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png"
                                            class="form-control @if ($errors->has('image')) is-invalid @endif"
                                        >
                                        @error('image')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="padding-top: 10px">
                                        <img src="{{ url($product->image_file_path) }}" alt="" style="width:200px;height:200px">
                                    </div>
                                </div>
                                <input type="submit" value="Update Stock" class="btn btn-success float-right">
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

@section('scripts')
    <script type="text/javascript">
    $("select").selectize();
    </script>
@endsection