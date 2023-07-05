@extends('admin.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                <h1>Comments</h1>
                </div>
                <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Comment</li>
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
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Complain</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->username }}</td>
                                    <td>{{ $comment->text }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="float: right;">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.comments.create', [$comment->id]) }}">
                            <i class="fas fa-comment"></i> @if (count($comments) == 0) Buat Comentar @else Balas @endif
                        </a>
                    </div>
                </div>
    
                <nav class="pull-right mt-3 mr-3">
                    {{ $comments->appends($_GET)->links() }}
                </nav>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
    
        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection