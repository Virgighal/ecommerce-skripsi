<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Warung Mbo'e</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">

    <style>
        body{
        margin-top:20px;
        background: #f6f9fc;
        }
        .account-block {
            padding: 0;
            background-image: url(https://bootdey.com/img/Content/bg1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            position: relative;
        }
        .account-block .overlay {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .account-block .account-testimonial {
            text-align: center;
            color: #fff;
            position: absolute;
            margin: 0 auto;
            padding: 0 1.75rem;
            bottom: 3rem;
            left: 0;
            right: 0;
        }

        .text-theme {
            color: #5369f8 !important;
        }

        .btn-theme {
            background-color: #5369f8;
            border-color: #5369f8;
            color: #fff;
        }
    </style>
</head>

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

<body class="hold-transition login-page">
    <div id="main-wrapper" class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-12">
                                <div class="pl-3 pt-3">
                                    <a href="{{ route('show-login') }}" class="btn btn-theme">Back</a>
                                </div>
                                <div class="p-5">
                                    <div class="mb-4">
                                        <h3 class="h4 font-weight-bold text-theme">Register</h3>
                                    </div>
    
                                    <form action="{{ route('do-register') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter Phone Number">
                                        </div>
                                        <button type="submit" class="btn btn-theme">Register</button>
                                    </form>
                                </div>
                            </div>

                        </div>
    
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->

                <p class="text-muted text-center mt-3 mb-0">Have an account already? <a href="register.html" class="text-primary ml-1"><a href="{{ route('show-login') }}">login</a></a></p>
    
                <!-- end row -->
    
            </div>
            <!-- end col -->
        </div>
        <!-- Row -->
    </div>
</body>
</html>