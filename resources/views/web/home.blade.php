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
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tentang Kami</h4>
            </div>
            <div class="row">
                <div class="col-md-40" style="width: 100%">
                    <h5>
                        Selamat datang di Warung Makan Mbo'e! Kami adalah warung makan yang berdedikasi untuk memberikan pengalaman kuliner yang luar biasa kepada pelanggan kami. Kami menggabungkan keahlian kuliner kami dengan cinta dan dedikasi untuk menciptakan hidangan lezat yang tak terlupakan.
                    </h5>
                    <br>
                    <h5>
                        Di Warung Makan Mbo'e, kami percaya bahwa makanan bukan hanya tentang memenuhi kebutuhan fisik, tetapi juga tentang membangun kenangan dan menghubungkan orang-orang. Itulah sebabnya kami berkomitmen untuk menyajikan hidangan dengan kualitas terbaik dan pelayanan yang ramah.
                    </h5>
                    <br>
                    <h5>
                        Setiap hidangan kami disiapkan dengan hati-hati oleh tim koki berbakat kami. Kami menggunakan bahan-bahan segar dan berkualitas tinggi untuk menciptakan rasa yang autentik dan lezat. Dari rempah-rempah pilihan hingga teknik memasak yang cermat, setiap detail diperhatikan agar hidangan kami memberikan kepuasan penuh bagi lidah Anda.
                    </h5>
                    <br>
                    <h5>
                        Selain itu, kami juga menghargai kebersihan dan kebersihan yang tinggi dalam setiap aspek operasional kami. Kami menjaga standar kebersihan yang ketat untuk memastikan bahwa setiap hidangan disajikan dengan kebersihan dan keamanan yang terjamin.
                    </h5>
                    <br>
                    <h5>
                        Terima kasih telah memilih Warung Makan Mbo'e. Kami berharap dapat menyambut Anda dengan senyuman hangat dan hidangan lezat. Bersama-sama, mari kita menjelajahi dunia cita rasa dan kepuasan kuliner.
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    {{-- <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Services</h4>
                <h1 class="display-4">Fresh & Organic Beans</h1>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-5">
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
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Service End -->


    <!-- Offer Start -->
    {{-- <div class="offer container-fluid my-5 py-5 text-center position-relative overlay-top overlay-bottom">
        <div class="container py-5">
            <h1 class="display-3 text-primary mt-3">50% OFF</h1>
            <h1 class="text-white mb-3">Sunday Special Offer</h1>
            <h4 class="text-white font-weight-normal mb-4 pb-3">Only for Sunday from 1st Jan to 30th Jan 2045</h4>
            <form class="form-inline justify-content-center mb-4">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Your Email" style="height: 60px;">
                    <div class="input-group-append">
                        <button class="btn btn-primary font-weight-bold px-4" type="submit">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
    <!-- Offer End -->


    <!-- Menu Start -->
    {{-- <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Menu & Pricing</h4>
                <h1 class="display-4">Competitive Pricing</h1>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="mb-5">Hot Coffee</h1>
                    <div class="row align-items-center mb-5">
                        <div class="col-4 col-sm-3">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('web-asset/img/menu-1.jpg') }}" alt="">
                            <h5 class="menu-price">$5</h5>
                        </div>
                        <div class="col-8 col-sm-9">
                            <h4>Black Coffee</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                        </div>
                    </div>
                    <div class="row align-items-center mb-5">
                        <div class="col-4 col-sm-3">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('web-asset/img/menu-2.jpg') }}" alt="">
                            <h5 class="menu-price">$7</h5>
                        </div>
                        <div class="col-8 col-sm-9">
                            <h4>Chocolete Coffee</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                        </div>
                    </div>
                    <div class="row align-items-center mb-5">
                        <div class="col-4 col-sm-3">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('web-asset/img/menu-3.jpg') }}" alt="">
                            <h5 class="menu-price">$9</h5>
                        </div>
                        <div class="col-8 col-sm-9">
                            <h4>Coffee With Milk</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h1 class="mb-5">Cold Coffee</h1>
                    <div class="row align-items-center mb-5">
                        <div class="col-4 col-sm-3">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('web-asset/img/menu-1.jpg') }}" alt="">
                            <h5 class="menu-price">$5</h5>
                        </div>
                        <div class="col-8 col-sm-9">
                            <h4>Black Coffee</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                        </div>
                    </div>
                    <div class="row align-items-center mb-5">
                        <div class="col-4 col-sm-3">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('web-asset/img/menu-2.jpg') }}" alt="">
                            <h5 class="menu-price">$7</h5>
                        </div>
                        <div class="col-8 col-sm-9">
                            <h4>Chocolete Coffee</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                        </div>
                    </div>
                    <div class="row align-items-center mb-5">
                        <div class="col-4 col-sm-3">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('web-asset/img/menu-3.jpg') }}" alt="">
                            <h5 class="menu-price">$9</h5>
                        </div>
                        <div class="col-8 col-sm-9">
                            <h4>Coffee With Milk</h4>
                            <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Menu End -->
@endsection