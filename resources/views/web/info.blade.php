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
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Info Pembayaran</h4>
            </div>
            <div class="row">
                <div class="col-md-40" style="width: 100%">
                    <h5>
                        skema berbelanja dengan cara penjual mendatangi pembeli ke rumah, lalu pembeli membayar di tempat adalah cara berjual beli yang telah ada bahkan sebelum menjamurnya sistem belanja online. Cash on delivery (COD) adalah jenis transaksi dimana pembeli membayar pesanan pada saat pengiriman daripada menggunakan kredit. Namun, dalam perkembangannya, sistem pembayaran COD juga diterapkan pada marketplace. Pada model seperti ini, pembeli bukan membayar langsung kepada penjual, melainkan melalui perantara kurir atau jasa pengiriman yang mengirimkan pesanan.
                    </h5>
                    <br>
                    <h5>
                        Langkah - langkah pembayaran Cash On Delivery 
                    </h5>
                    <br>
                    <h5>
                        1. Setelah Anda memesan pembelian Anda melalui marketplace tertentu, penjual mengirim pesanan melalui karyawan warung mbo'e tersebut.  untuk mengirimkan kiriman dan mengumpulkan pembayaran bisa melalui via bank Mandiri A.n Wahyu Rasyid Almanan 1330023865355 .
                    </h5>
                    <br>
                    <h5>
                        2. Setelah pesanan dilakukan makanan dan minuman yang bersangkutan dikemas oleh pemasok maupun penjual. Saat ini pula pengirim akan menyiapkan invoice untuk direkatkan pada paket.
                    </h5>
                    <br>
                    <h5>
                        3. Kiriman bersama dengan invoice diserahkan untuk mengirimkan pesanan dan mendapat pembayaran secara tunai dari pembeli.
                    </h5>
                    <br>
                    <h5>
                        4. karyawan pengiriman diberi wewenang untuk mengambil uang tunai segera setelah pengiriman pesanan ke depan pintu pembeli. dengan cara memberikan foto bukti saat menerima pesanan dan saat membayar lalu uplode foto bukti cod ke website user pelanggan di tampilan checkout. Namun, beberapa perusahaan juga menerima pembayaran kartu pada saat pengiriman. 
                    </h5>
                    <br>
                    <h5>
                        5. Setelah mengumpulkan jumlah tagihan, karyawan pengiriman menyetorkannya ke warung mbo'e. setelah itu karyawan pengiriman pesanan  menyerahkan uang tunai kepada pemasok atau marketplace setelah dikurangi biaya penanganan. Uang tersebut akhirnya sampai ke pedagang produk yang dipesan.
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection