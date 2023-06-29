@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-6">
                        <h1>View Order</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">View Order</li>
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
                            <h3 class="card-title">View Order</h3>
                        </div>
                        <form action="{{ route('admin.orders.update', [ $order->id ]) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name">Order Date</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control"
                                            value="{{ $order->created_at }}" disabled>
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="user_name">Order User Name</label>
                                        <input type="text" name="user_name" id="user_name"
                                            class="form-control"
                                            value="{{ $order->user_name }}" disabled>
                                        @error('user_name')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="total_price">Total Price</label>
                                        <input type="number" name="total_price" id="total_price"
                                            class="form-control"
                                            value="{{ $order->total_price }}" disabled>
                                        @error('total_price')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="delivery_address">Delivery Address</label>
                                        <textarea class="form-control" name="delivery_address" disabled id="" cols="30" rows="10">{{ $order->delivery_address }}</textarea>
                                        @error('total_price')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div style="padding-top: 10px">
                                        <img src="{{ url($order->bukti_pembayaran) }}" alt="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="selectpicker">
                                            <option value="">Please Select</option>
                                            <option value="Menunggu Konfirmasi" @if($order->status == 'Menunggu Konfirmasi') selected @endif>Menunggu Konfirmasi</option>
                                            <option value="Konfirmasi" @if($order->status == 'Konfirmasi') selected @endif>Konfirmasi</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <input type="submit" value="Update Order" class="btn btn-success float-right">
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