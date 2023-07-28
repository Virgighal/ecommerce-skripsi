@extends('web.app')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" style="height: 500px" src="{{ asset('web-asset/img/background.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        {{-- <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2> --}}
                        <h1 class="display-1 text-white m-0">Warung Mbo'e</h1>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    {{-- <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Menu</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Our Story</h1>
                    <h5 class="mb-3">Eos kasd eos dolor vero vero, lorem stet diam rebum. Ipsum amet sed vero dolor sea</h5>
                    <p>Takimata sed vero vero no sit sed, justo clita duo no duo amet et, nonumy kasd sed dolor eos diam lorem eirmod. Amet sit amet amet no. Est nonumy sed labore eirmod sit magna. Erat at est justo sit ut. Labor diam sed ipsum et eirmod</p>
                    <a href="" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Learn More</a>
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('web-asset/img/about.png') }}" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Our Vision</h1>
                    <p>Invidunt lorem justo sanctus clita. Erat lorem labore ea, justo dolor lorem ipsum ut sed eos, ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea ipsum est dolor</p>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</h5>
                    <a href="" class="btn btn-primary font-weight-bold py-2 px-4 mt-2">Learn More</a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-fluid pt-5" id="profile">
        @if(Session::has('success_message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success_message') }}
            </div>
        @endif
        <div class="container">
            <div class="row">

                <style>
                    p {
                        margin: 0px 0px 20px 0px;
                    }

                    .checked {
                        color: orange;
                    }

                    p:last-child {
                        margin: 0px;
                    }

                    a {
                        color: #71748d;
                    }

                    a:hover {
                        color: #ff407b;
                        text-decoration: none;
                    }

                    a:active,
                    a:hover {
                        outline: 0;
                        text-decoration: none;
                    }

                    .btn-secondary {
                        color: #fff;
                        background-color: #ff407b;
                        border-color: #ff407b;
                    }

                    .btn {
                        font-size: 14px;
                        padding: 9px 16px;
                        border-radius: 2px;
                    }


                    .tab-vertical .nav.nav-tabs {
                        float: left;
                        display: block;
                        margin-right: 0px;
                        border-bottom: 0;
                    }

                    .tab-vertical .nav.nav-tabs .nav-item {
                        margin-bottom: 6px;
                    }

                    .tab-vertical .nav-tabs .nav-link {
                        border: 1px solid transparent;
                        border-top-left-radius: .25rem;
                        border-top-right-radius: .25rem;
                        background: #fff;
                        padding: 17px 49px;
                        color: #71748d;
                        background-color: #dddde8;
                        -webkit-border-radius: 4px 0px 0px 4px;
                        -moz-border-radius: 4px 0px 0px 4px;
                        border-radius: 4px 0px 0px 4px;
                    }

                    .tab-vertical .nav-tabs .nav-link.active {
                        color: #5969ff;
                        background-color: #fff !important;
                        border-color: transparent !important;
                    }

                    .tab-vertical .nav-tabs .nav-link {
                        border: 1px solid transparent;
                        border-top-left-radius: 4px !important;
                        border-top-right-radius: 0px !important;
                    }

                    .tab-vertical .tab-content {
                        overflow: auto;
                        -webkit-border-radius: 0px 4px 4px 4px;
                        -moz-border-radius: 0px 4px 4px 4px;
                        border-radius: 0px 4px 4px 4px;
                        background: #fff;
                        padding: 30px;
                    }
                </style>

                @php
                    $totalNotifications = \App\Models\Notification::where('user_id', auth()->user()->id)
                        ->where('is_read', 0)
                        ->count()
                @endphp
                <div class="container d-flex justify-content-center mt-20">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                        <div class="tab-vertical">
                            <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="my-profile-tab" data-toggle="tab" href="#my-profile" role="tab" aria-controls="home" aria-selected="true"> <i class="fa fa-user" style="color: black;padding-right:10px"></i>My Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="order-history-tab" data-toggle="tab" href="#order-history" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-clock" style="color: black;padding-right:10px"></i> Order History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="notification-tab" data-toggle="tab" href="#notification" role="tab" aria-controls="notification" aria-selected="false">
                                        <i class="fa fa-bell" style="color: black;padding-right:10px"></i>Notification                         
                                        @if ($totalNotifications > 0)
                                            <span style="margin-left:20px;font-size: 15px" class="badge badge-danger">{{ $totalNotifications }}</span> 
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <form action="{{ route('logout') }}" method="POST" id='logoutForm'>
                                        @csrf
                                    </form>
                                    <script type="text/javascript">
                                        function confirmLogout() {
                                            if(confirm("Are you sure you want to log out?")) {
                                                document.getElementById('logoutForm').submit();
                                            }
                                        }
                                    </script>
                                    <a class="nav-link" style="background-color: #ff6c9b;color:white" href="#" role="tab" onclick='confirmLogout()'><i class="fa fa-power-off" style="color: black;padding-right:10px"></i> Log Out</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="#" role="tab" onclick='refresh()'><i class="fa fa-refresh" style="color: black;padding-right:10px;height:100%"></i>Refresh Page</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent3">
                                @php
                                    $order_tab_active = '';
                                    $profile_tab_active = '';
                                    $notification_tab_active = '';
                                    if(Session::has('active_page')) {
                                        $active_page = Session::get('active_page');
                                    }

                                    if($active_page == 'order_history') {
                                        $order_tab_active = 'show order history active';
                                    } else {
                                        $profile_tab_active = 'show profile active';
                                    }
                                @endphp
                                <div class="tab-pane fade {{ $profile_tab_active }}" id="my-profile" role="tabpanel" aria-labelledby="my-profile-tab">
                                    <form action="{{ route('change-profile') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control" id="phone" value="{{ $user->phone_number }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Address</label>
                                            <textarea class="form-control" name="address" id="" cols="30" rows="10">{{ $user->address }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade {{ $order_tab_active }}" id="order-history" role="tabpanel" aria-labelledby="order-history-tab">
                                    @foreach ($orders as $order)
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <b style="font-size: 20px">#{{ $order->transaction_number }} </b>
                                                <br>
                                                Order Date: {{ $order->created_at }} <br>
                                                Method: {{ $order->payment_method }} <br>
                                                Total Price: Rp. {{ number_format($order->total_price) }} <br>
                                                Delivery Fee: Rp. {{ number_format($order->delivery_fee) }} <br>
                                                Status: 
                                                @if($order->status == 'Selesai Pengiriman' || $order->status == 'Pesanan Selesai' || $order->status == 'Pesanan Diterima') 
                                                    <span style="font-size: 20px" class="badge badge-success">{{ $order->status }}</span> 
                                                @else
                                                    <span style="font-size: 20px" class="badge badge-warning">{{ $order->status }}</span> 
                                                @endif
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Product Name</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Image</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="padding: 10px">
                                                        @foreach($order->products as $product)
                                                            <tr>
                                                                <td> {{ !empty($product->product) ? $product->product->name : 'N/A' }}</td>
                                                                <td>Rp. {{ number_format($product->price) }}</td>
                                                                <td>{{ number_format($product->quantity) }}</td>
                                                                @if(!empty($product->product))
                                                                    <td><img width="100px" height="100px" src="{{ $product->product->image_file_path }}" alt=""></td>
                                                                @else
                                                                    <td>N/A</td>
                                                                @endif
                                                                <td style="white-space: nowrap;">
                                                                    <div style="display: flex;gap:10px;flex-wrap:wrap">
                                                                        @if(!empty($product->product) && ($order->status == 'Selesai Pengiriman' || $order->status == 'Pesanan Selesai'))
                                                                            <a class="btn btn-primary btn-sm" href="{{ route('ratings.index', 
                                                                                [
                                                                                    'rateableType' => $product->product,
                                                                                    'rateableId' => $product->product->id
                                                                                ]) }}">
                                                                                <i class="fas fa-star"></i> Beri Rating
                                                                            </a>
                                                                            <a class="btn btn-primary btn-sm" href="{{ route('comment', 
                                                                            [
                                                                                'order_id' => $order->id,
                                                                            ]) }}">
                                                                                <i class="fa fa-comment" aria-hidden="true"></i> Beri Komentar
                                                                            </a>
                                                                            @if ($order->status == 'Selesai Pengiriman')
                                                                                <a class="btn btn-primary btn-sm" href="{{ route('profile.confirm-order', 
                                                                                [
                                                                                    $order->id,
                                                                                ]) }}">
                                                                                    <i class="fa fa-check" aria-hidden="true"></i> Konfirmasi Pesanan Diterima
                                                                                </a>
                                                                                <a class="btn btn-primary btn-sm" href="{{ route('profile.reject-order', 
                                                                                [
                                                                                    $order->id,
                                                                                ]) }}">
                                                                                    <i class="fa fa-times" aria-hidden="true"></i> Konfirmasi Pesanan Belum Diterima
                                                                                </a>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                <td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane fade {{ $notification_tab_active }}" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                                    @foreach ($notifications as $notification)
                                        <div class="card mb-4"  onclick="openNotification()">
                                            <div class="card-body">
                                                @php
                                                    $message = '';
                                                    if($notification->status == 'Proses Pengiriman') {
                                                        $message = 'Pesanan sedang dalam proses pengiriman!';
                                                    } elseif($notification->status == 'Selesai Pengiriman') {
                                                        $message = 'Pesanan telah sampai ke tujuan!';
                                                    }
                                                @endphp
                                                <div style="display: flex;gap:40px;cursor: pointer;">
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
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection

@section('scripts')
    <script type="text/javascript">
        const element = document.getElementById("profile");
        element.scrollIntoView();

        function openNotification() {
            $('#order-history-tab').tab('show');
            // Show the "order-history" tab content
            $('#order-history').addClass('show active');
            $('#notification').removeClass('show active');
            
            // Scroll to the "order-history" tab content if needed
            $('html, body').animate({
                scrollTop: $('#order-history').offset().top
            }, 1000); // Adjust the duration (in milliseconds) as needed

            $.ajax({
                url: '/profile/update-notification-status',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Add CSRF token if needed
                    user_id: {{ auth()->user()->id }},
                },
                success: function(response) {
                    console.log('Notification status updated successfully.');
                },
                error: function(error) {
                    console.error('Failed to update notification status.');
                }
            });
        }

        function refresh(){
            window.location.reload();
        }
    </script>
@endsection