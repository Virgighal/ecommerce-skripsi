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
    <div class="container-fluid pt-5" id="shopping-cart">
        <div class="container">
            <div class="row">
                <div class="cart_section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cart_container">
                                    <div class="cart_title">Keranjang<small> ({{ $total_products }} Item) </small></div>
                                    <div class="cart_items">
                                        <ul class="cart_list">
                                            @foreach ($cart_items as $index => $item)
                                                <li class="cart_item clearfix">
                                                    <div class="cart_item_image">
                                                        <img src="{{ url($item->product->image_file_path) }}" alt="">
                                                    </div>
                                                    <div class="cart_item_info" style="display: flex;justify-content:space-between;gap:30px">
                                                        <div class="cart_item_name cart_info_col" style="width: 50%">
                                                            <div class="cart_item_title">Nama</div>
                                                            <div class="cart_item_text">{{ $item->product->name }}</div>
                                                        </div>
                                                        <div class="cart_item_quantity cart_info_col" style="width: 25%">
                                                            <div class="cart_item_title">Jumlah</div>
                                                            <div style="display: flex;gap:10px">
                                                                <div class="cart_item_text mt-10">
                                                                    <form action="{{ route('deduct') }}" method="POST" class="deduct-form">
                                                                        @csrf
                                                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                                        <i onclick="confirmDeduct(event)" class="fa fa-minus-circle" style="color: red"></i>
                                                                    </form>
                                                                </div>

                                                                <div class="cart_item_text">{{ $item->quantity }}</div>

                                                                <div class="cart_item_text">
                                                                    <form action="{{ route('add-to-cart') }}" method="POST" class="add-form">
                                                                        @csrf
                                                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                                        <i onclick="confirmAdd(event)" class="fa fa-plus-circle" style="color: green"></i>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cart_item_price cart_info_col" style="width: 25%">
                                                            <div class="cart_item_title">Harga</div>
                                                            <div class="cart_item_text">Rp {{ number_format($item->product->price) }}</div>
                                                        </div>
                                                        <div class="cart_item_total cart_info_col" style="width: 25%">
                                                            <div class="cart_item_title">Total</div>
                                                            <div class="cart_item_text">Rp {{ number_format($item->price) }}</div>
                                                        </div>
                                                        <div class="cart_item_name cart_info_col" style="width: 20%">
                                                            <div class="cart_item_title">Option</div>
                                                            <div class="cart_item_text">
                                                                <form action="{{ route('delete') }}" method="POST" class="delete-form">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                                    <i onclick="confirmDelete(event)" class="fa fa-trash" style="color: red"></i>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="order_total">
                                        <div class="order_total_content text-md-right">
                                            <div class="order_total_title">Total Belanja</div>
                                            <div class="order_total_amount">Rp {{ number_format($total_price) }}</div>
                                        </div>
                                    </div>
                                    <div class="cart_buttons"> 
                                        <a href="{{ route('menu') }}">
                                            @if(count($cart_items) > 0)
                                                <button type="button" class="button cart_button_clear">Lanjut Belanja</button>
                                            @else
                                                <button type="button" class="button cart_button_clear">Mulai Belanja</button>
                                            @endif
                                        </a>
                                        @if(count($cart_items) > 0)
                                            <a href="{{ route('checkout') }}">
                                                <button type="button" class="button cart_button_checkout">Checkout Belanjaan</button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @foreach ($products as $product)
                    <div class="col-lg-6 mb-5">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <img class="img-fluid mb-3 mb-sm-0" src="{{ url($product->image_file_path) }}" alt="" style="width:200px;height:200px; border-radius: 5%">
                            </div>
                            <div class="col-sm-7">
                                <h4>{{ $product->name }}</h4>
                                <h5>Rp. {{ number_format($product->price, 2) }}</h5>
                                <form action="{{ route('add-to-cart') }}" method="POST">
                                    @csrf
                                    <input type="text" name="name" id="name" hidden value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus mr-2"></i> Masukkan Ke Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
                {{-- <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="{{ asset('web-asset/img/service-1.jpg') }}" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-truck service-icon"></i>Fastest Door Delivery</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit
                                invidunt, dolore tempor diam ipsum takima erat tempor</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="{{ asset('web-asset/img/service-2.jpg') }}" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-coffee service-icon"></i>Fresh Coffee Beans</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit
                                invidunt, dolore tempor diam ipsum takima erat tempor</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="{{ asset('web-asset/img/service-3.jpg') }}" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-award service-icon"></i>Best Quality Coffee</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit
                                invidunt, dolore tempor diam ipsum takima erat tempor</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="{{ asset('web-asset/img/service-4.jpg') }}" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-table service-icon"></i>Online Table Booking</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo. Guberg sea et et lorem dolor sed est sit
                                invidunt, dolore tempor diam ipsum takima erat tempor</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection

@section('scripts')
    <script type="text/javascript">
        const element = document.getElementById("shopping-cart");
        element.scrollIntoView();

        function confirmDeduct(event) {
            event.preventDefault();
            if (confirm("Apakah ingin mengurangi jumlah pemesanan?")) {
                event.target.parentNode.submit();
            }
        }

        function confirmAdd(event) {
            event.preventDefault();
            if (confirm("Apakah ingin menambah jumlah pemesanan?")) {
                event.target.parentNode.submit();
            }
        }

        function confirmDelete(event) {
            event.preventDefault();
            if (confirm("Apakah ingin menambah jumlah pemesanan?")) {
                event.target.parentNode.submit();
            }
        }
    </script>
@endsection