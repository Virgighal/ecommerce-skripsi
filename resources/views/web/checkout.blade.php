@extends('web.app')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('web-asset/img/header-home.jpeg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        {{-- <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2> --}}
                        <h1 class="display-1 text-white m-0">Warung Mbo'e</h1>
                        <h2 class="text-white m-0">* Sejak 2022 *</h2>
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
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="row">

                <style>
                    .card{
                        margin: auto;
                        width: 600px;
                        padding: 3rem 3.5rem;
                        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                    }

                    .mt-50 {
                        margin-top: 50px
                    }

                    .mb-50 {
                        margin-bottom: 50px
                    }


                    @media(max-width:767px){
                        .card{
                            width: 90%;
                            padding: 1.5rem;
                        }
                    }
                    @media(height:1366px){
                        .card{
                            width: 90%;
                            padding: 8vh;
                        }
                    }
                    .card-title{
                        font-weight: 700;
                        font-size: 2.5em;
                    }
                    .nav{
                        display: flex;
                    }
                    .nav ul{
                        list-style-type: none;
                        display: flex;
                        padding-inline-start: unset;
                        margin-bottom: 6vh;
                    }
                    .nav li{
                        padding: 1rem;
                    }
                    .nav li a{
                        color: black;
                        text-decoration: none;
                    }
                    .active{
                        border-bottom: 2px solid black;
                        font-weight: bold;
                    }

                    input{
                        border: none;
                        outline: none;
                        font-size: 1rem;
                        font-weight: 600;
                        color: #000;
                        width: 100%;
                        min-width: unset;
                        background-color: transparent;
                        border-color: transparent;
                        margin: 0;
                    }
                    form a{
                        color:grey;
                        text-decoration: none;
                        font-size: 0.87rem;
                        font-weight: bold;
                    }
                    form a:hover{
                        color:grey;
                        text-decoration: none;
                    }
                    form .row{
                        margin: 0;
                        overflow: hidden;
                    }
                    form .row-1{
                        border: 1px solid rgba(0, 0, 0, 0.137);
                        padding: 0.5rem;
                        outline: none;
                        width: 100%;
                        min-width: unset;
                        border-radius: 5px;
                        background-color: rgba(221, 228, 236, 0.301);
                        border-color: rgba(221, 228, 236, 0.459);
                        margin: 2vh 0;
                        overflow: hidden;
                    }
                    form .row-2{
                        border: none;
                        outline: none;
                        background-color: transparent;
                        margin: 0;
                        padding: 0 0.8rem;
                    }
                    form .row .row-2{
                        border: none;
                        outline: none;
                        background-color: transparent;
                        margin: 0;
                        padding: 0 0.8rem;
                    }
                    form .row .col-2,.col-7,.col-3{
                        display: flex;
                        align-items: center;
                        text-align: center;
                        padding: 0 1vh;
                    }
                    form .row .col-2{
                        padding-right: 0;
                    }

                    #card-header{
                        font-weight: bold;
                        font-size: 0.9rem;
                    }
                    #card-inner{
                        font-size: 0.7rem;
                        color: gray;
                    }
                    .three .col-7{
                        padding-left: 0;
                    }
                    .three{
                        overflow: hidden;
                        justify-content: space-between;
                    }
                    .three .col-2{
                        border: 1px solid rgba(0, 0, 0, 0.137);
                        padding: 0.5rem;
                        outline: none;
                        width: 100%;
                        min-width: unset;
                        border-radius: 5px;
                        background-color: rgba(221, 228, 236, 0.301);
                        border-color: rgba(221, 228, 236, 0.459);
                        margin: 2vh 0;
                        width: fit-content;
                        overflow: hidden; 
                    }
                    .three .col-2 input{
                        font-size: 0.7rem;
                        margin-left: 1vh;
                    }
                    .btn{
                        width: 100%;
                        background-color: rgb(65, 202, 127);
                        border-color: rgb(65, 202, 127);
                        color: white;
                        justify-content: center;
                        padding: 2vh 0;
                        margin-top: 3vh;
                    }
                    .btn:focus{
                        box-shadow: none;
                        outline: none;
                        box-shadow: none;
                        color: white;
                        -webkit-box-shadow: none;
                        -webkit-user-select: none;
                        transition: none; 
                    }
                    .btn:hover{
                        color: white;
                    }
                    input:focus::-webkit-input-placeholder { 
                        color:transparent; 
                    }
                    input:focus:-moz-placeholder { 
                        color:transparent; 
                    } 
                    input:focus::-moz-placeholder { 
                        color:transparent; 
                    } 
                    input:focus:-ms-input-placeholder { 
                        color:transparent; 
                    }
                </style>
                
                <div class="card mt-50 mb-50">
                    <div class="card-title mx-auto">
                        Checkout
                    </div>
                    <form action="{{ route('pay') }}" method="POST" enctype="multipart/form-data" style="margin-top: 20px">
                        @csrf
                        <span id="card-header">Total:</span> 
                        <div class="row row-1">
                            <div class="col-7">
                                <input type="text" placeholder="Rp. {{ $total_price }}">
                            </div>
                        </div>

                        <span id="card-header">Transfer to:</span>
                        <div class="row row-1">
                            <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/color/48/000000/mastercard-logo.png"/></div>
                            <div class="col-7">
                                <input type="text" placeholder="12837 81729 (BCA)">
                            </div>
                        </div>
                        <div class="row row-1">
                            <div class="col-2"><img  class="img-fluid" src="https://img.icons8.com/color/48/000000/visa.png"/></div>
                            <div class="col-7">
                                <input type="text" placeholder="28742 82987 (BCA)">
                            </div>
                        </div>
                        <span id="card-header">Bukti Pembayaran:</span>
                        <div class="row-1">
                            <div class="row row-2">
                                <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                        <button class="btn d-flex mx-auto"><b>Submit</b></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection