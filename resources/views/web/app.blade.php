<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Warung Mbo'e</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="{{ asset('web-asset/img/favicon.ico') }}" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('web-asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web-asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('web-asset/css/style.min.css') }}" rel="stylesheet">

    {{-- @notifyCss --}}

    <style>
        *{margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-webkit-text-shadow: rgba(0,0,0,.01) 0 0 1px;text-shadow: rgba(0,0,0,.01) 0 0 1px}body{font-family: 'Rubik', sans-serif;font-size: 14px;font-weight: 400;color: #000000}ul{list-style: none;margin-bottom: 0px}.button{display: inline-block;background: #0e8ce4;border-radius: 5px;height: 48px;-webkit-transition: all 200ms ease;-moz-transition: all 200ms ease;-ms-transition: all 200ms ease;-o-transition: all 200ms ease;transition: all 200ms ease}.button a{display: block;font-size: 18px;font-weight: 400;line-height: 48px;color: #FFFFFF;padding-left: 35px;padding-right: 35px}.button:hover{opacity: 0.8}.cart_section{width: 100%;padding-top: 93px;padding-bottom: 111px}.cart_title{font-size: 30px;font-weight: 500}.cart_items{margin-top: 8px}.cart_list{border: solid 1px #e8e8e8;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);background-color: #fff}.cart_item{width: 100%;padding: 15px;padding-right: 46px}.cart_item_image{width: 133px;height: 133px;float: left}.cart_item_image img{max-width: 100%}.cart_item_info{width: calc(100% - 133px);float: left;padding-top: 18px}.cart_item_name{margin-left: 7.53%}.cart_item_title{font-size: 14px;font-weight: 400;color: rgba(0,0,0,0.5)}.cart_item_text{font-size: 18px;margin-top: 35px}.cart_item_text span{display: inline-block;width: 20px;height: 20px;border-radius: 50%;margin-right: 11px;-webkit-transform: translateY(4px);-moz-transform: translateY(4px);-ms-transform: translateY(4px);-o-transform: translateY(4px);transform: translateY(4px)}.cart_item_price{text-align: right}.cart_item_total{text-align: right}.order_total{width: 100%;height: 60px;margin-top: 30px;border: solid 1px #e8e8e8;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);padding-right: 46px;padding-left: 15px;background-color: #fff}.order_total_title{display: inline-block;font-size: 14px;color: rgba(0,0,0,0.5);line-height: 60px}.order_total_amount{display: inline-block;font-size: 18px;font-weight: 500;margin-left: 26px;line-height: 60px}.cart_buttons{margin-top: 60px;text-align: right}.cart_button_clear{display: inline-block;border: none;font-size: 18px;font-weight: 400;line-height: 48px;color: rgba(0,0,0,0.5);background: #FFFFFF;border: solid 1px #b2b2b2;padding-left: 35px;padding-right: 35px;outline: none;cursor: pointer;margin-right: 26px}.cart_button_clear:hover{border-color: #0e8ce4;color: #0e8ce4}.cart_button_checkout{display: inline-block;border: none;font-size: 18px;font-weight: 400;line-height: 48px;color: #FFFFFF;padding-left: 35px;padding-right: 35px;outline: none;cursor: pointer;vertical-align: top}
    </style>
</head>

<body>
    {{-- <x-notify::notify />
    @notifyJs --}}

    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="{{ route('home') }}" class="navbar-brand px-lg-4 m-0">
                <img src="{{ asset('web-asset/img/logo.jpeg') }}" alt="Image" style="width: 100px;height:100px;border-radius:10px">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <img src="" alt="">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="{{ route('home') }}" class="nav-item nav-link @if($active_menu == 'home') active @endif">Beranda</a>
                    <a href="{{ route('menu') }}" class="nav-item nav-link @if($active_menu == 'menu') active @endif">Menu</a>
                    <a href="{{ route('cart') }}" class="nav-item nav-link @if($active_menu == 'cart') active @endif">Keranjang</a>
                    <a href="{{ route('profile') }}" class="nav-item nav-link @if($active_menu == 'profile') active @endif">Profile</a>
                    @if(empty(auth()->user()))
                        <a href="{{ route('admin.home') }}" class="nav-item nav-link">Admin</a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Hubungi Kami</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>BSI 2 Jl. Cendrawasih 9A Blok C4 RT 04/10 No 12 Kelurahan Pengasinan, Kecamatan Sawangan, Kota Depok, Kode Pos 16518</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+6812-8304-4180</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>achmadnurrohman9@gmail.com</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>wahyurasyidalmanan@gmail.com</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Buka Setiap :</h4>
                <div>
                    <h6 class="text-white text-uppercase">Senin - Sabtu</h6>
                    <p>7.00 AM - 4.00 PM</p>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="#">Domain</a>. All Rights Reserved.</a></p>
            <p class="m-0 text-white">Designed by <a class="font-weight-bold" href="#">Achmad Nurrohman (NPM : 4518210016)</a></p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('web-asset/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('web-asset/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('web-asset/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web-asset/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('web-asset/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('web-asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('web-asset/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('web-asset/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('web-asset/js/main.js') }}"></script>

    {{-- @notifyJs --}}

    @yield('scripts')
</body>

</html>