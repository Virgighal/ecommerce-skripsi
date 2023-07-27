@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                <h1>Notifications</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Notifications</li>
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
                        Filter
                    </p>
                    <form action="{{ route('admin.notifications.index') }}" method="GET">
                        <div style="display: flex;gap:20px">
                            <div style="width:30%">
                                <label for="type">Status</label>
                                <select name="status" class="form-control" id="">
                                    @php
                                        $options = [
                                            [
                                                'label' => 'Menunggu Konfirmasi',
                                                'value' => 'Menunggu Konfirmasi'
                                            ],
                                            [
                                                'label' => 'Proses Pengiriman',
                                                'value' => 'Proses Pengiriman'
                                            ],
                                            [
                                                'label' => 'Selesai Pengiriman',
                                                'value' => 'Selesai Pengiriman'
                                            ],
                                            [
                                                'label' => 'Pesanan Diterima',
                                                'value' => 'Pesanan Diterima'
                                            ]
                                        ]
                                    @endphp
                                    <option value="">Please select status</option>
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
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        {{-- <thead>
                            <tr>
                                <th>Transaction Number</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>
                                        @php
                                            $message = '';
                                            if($notification->status == 'Menunggu Konfirmasi') {
                                                $message = 'Pesanan menunggu untuk dikonfimasi!';
                                            } elseif($notification->status == 'Pesanan Diterima') {
                                                $message = 'Pesanan telah diterima oleh user!';
                                            }
                                        @endphp
                                        <div style="display: flex;gap:40px">
                                            <div>
                                                <div style="background-color:red;width:50px;border-radius:5px">
                                                    <a style="height: 30px;margin-top:20px;margin-left:8px;color:white">
                                                        <b>New</b>
                                                    </a>
                                                </div>
                                            </div>
                                            <div style="width: 500px;line-height:1">
                                                <span style="font-size: 17px" class="badge badge-success">{{ $message }}</span> 
                                                <p><b>Order Number : #{{ $notification->transaction_number }}</b></p>
                                                <p><b>Customer Name : #{{ $notification->customer_name }}</b></p>
                                            </div>
                                            <a class="btn btn-primary btn-sm" style="height: 30px;margin-top:20px" href="{{ route('admin.orders.show', [$notification->transaction_id]) }}">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <nav class="pull-right mt-3 mr-3">
                    {!! $notifications->appends($_GET)->links() !!}
                </nav>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection