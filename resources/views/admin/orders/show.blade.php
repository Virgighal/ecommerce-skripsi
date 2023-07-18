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
                    <div class="card">
                        <div class="card-header">
                            @if($order->status == 'Selesai Pengiriman' || $order->status == 'Pesanan Selesai') 
                                <span style="font-size: 20px" class="badge badge-success">{{ $order->status }}</span> 
                            @else
                                <span style="font-size: 20px" class="badge badge-warning">{{ $order->status }}</span> 
                            @endif
                            @if ($order->payment_method == 'Langsung')
                                <div style="float: right">
                                    <a class="btn btn-primary" target="_blank" href="{{ route('admin.orders.print', [ $order->id ]) }}"><i class="fa fa-print" aria-hidden="true"></i> Cetak Struk</a>
                                </div>
                            @endif
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
                                        <label for="payment_method">Payment Method</label>
                                        <input type="text" name="payment_method" id="payment_method"
                                            class="form-control"
                                            value="{{ $order->payment_method }}" disabled>
                                        @error('payment_method')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="delivery_fee">Delivery Fee</label>
                                        <input type="number" name="delivery_fee" id="delivery_fee"
                                            class="form-control"
                                            value="{{ $order->delivery_fee }}" disabled>
                                        @error('delivery_fee')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                @if(!empty($order->delivery_address))
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="delivery_address">Delivery Address</label>
                                            <textarea class="form-control" name="delivery_address" disabled id="" cols="30" rows="10">{{ $order->delivery_address }}</textarea>
                                            @error('total_price')
                                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div style="padding-top: 10px">
                                        <img src="{{ url($order->bukti_pembayaran) }}" alt="">
                                    </div>
                                </div>

                                @if ($order->status == 'Menunggu Konfirmasi' || $order->status == 'Proses Pengiriman')
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="selectpicker" onchange="checkStatus()">
                                                @if ($order->status == 'Menunggu Konfirmasi')
                                                    <option value="Proses Pengiriman" @if($order->status == 'Proses Pengiriman') selected @endif>Proses Pengiriman</option>
                                                @endif
                                                @if ($order->status == 'Proses Pengiriman')
                                                    <option value="Selesai Pengiriman" @if($order->status == 'Selesai Pengiriman') selected @endif>Selesai Pengiriman</option> 
                                                @endif
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group" id="orderImage" style="display: none">
                                    <div class="col-md-12">
                                        <label for="image">Bukti Selesai</label>
                                        <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png"
                                            class="form-control @if ($errors->has('image')) is-invalid @endif"
                                        >
                                        @error('image')
                                            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="padding-top: 10px">
                                        @if (!empty($order->image_file_path))
                                            <img src="{{ asset($order->image_file_path) }}" alt="" style="width:200px;height:200px">
                                        @endif
                                    </div>
                                </div>

                                @if ($order->status == 'Menunggu Konfirmasi' || $order->status == 'Proses Pengiriman')
                                    <input type="submit" value="Update Status" class="btn btn-success float-right">
                                @endif
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody style="padding: 10px">
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td> {{ !empty($item->product) ? $item->product->name : 'N/A' }}</td>
                                            <td>Rp. {{ number_format($item->price) }}</td>
                                            <td>{{ number_format($item->quantity) }}</td>
                                            @if(!empty($item->product))
                                                <td><img width="100px" height="100px" src="{{ url($item->product->image_file_path) }}" alt=""></td>
                                            @else
                                                <td>N/A</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    <!-- /.card-body -->
                    </div>
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

        function checkStatus() {
            let statusForm = document.getElementById("status");
            let status = document.getElementById("status").value;
            let orderImage = document.getElementById("orderImage");

            if(status === 'Selesai Pengiriman') {
                orderImage.style.display = "block";
            }

            const element = document.getElementById("comment-card");
            element.scrollIntoView();
        }

        window.document.onload = checkStatus()
    </script>
@endsection