@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                <h1>Reports</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reports</li>
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
                        Search
                    </p>
                    <form action="{{ route('admin.report.report') }}" method="GET"  id="reportForm">
                        <div style="display: flex;gap:20px">
                            <div style="width: 30%">
                                <label for="transaction_number">Transaction Number</label>
                                <input type="text" class="form-control" autocomplete="off" name="transaction_number" placeholder="Transaction Number">
                            </div>
                            <div style="width: 30%">
                                <label for="start_date">Start Date</label>
                                <input type="text" class="form-control datepicker" autocomplete="off" name="start_date" placeholder="Enter Start Date">
                            </div>
                            <div style="width: 30%">
                                <label for="end_date">End Date</label>
                                <input type="text" class="form-control datepicker" autocomplete="off" name="end_date" placeholder="Enter End Date">
                            </div>
                            <div style="width: 30%">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="product_name" placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div style="width: 20%">
                            <button type="submit" class="btn btn-primary" style="margin-top:30px">Download Excel</button>
                            <button type="submit" class="btn btn-primary" style="margin-top:30px" id="printPdfBtn">Print PDF</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->

        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
            });

            $("#printPdfBtn").click(function() {
            $("#reportForm").attr('action', '{{ route("admin.report.print-pdf") }}').attr('target', '_blank').submit();
            setTimeout(() => {
                $("#reportForm").attr('action', '{{ route("admin.report.report") }}').attr('target', '');
            }, 100);
        });
        });
    </script>
@endsection