@extends('wp.layout.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Login WP</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><a href="{{ route('wp.login') }}">Login WP</a></li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3>Login ke akun WP anda</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                        <form method="POST" action="">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>NIK WP</label>
                                    <input type="number" name="nik_wp" class="form-control @error('nik_wp') is-invalid @enderror" placeholder="NIK WP" maxlength="16" value="{{ old('nik_wp') }}" required autofocus>
                                    @error('nik_wp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password_wp" class="form-control @error('password_wp') is-invalid @enderror" placeholder="Password" maxlength="16" value="{{ old('password_wp') }}" required>
                                    @error('password_wp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="g-recaptcha text-center" data-sitekey="{{ env('GOOGLE_RECHATPTCHA_SITEKEY') }}" data-callback="enableBtn"></div>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Belum punya akun? klik <a href="#">di sini.</a>.</label>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="reset" class="btn btn-danger">Batal</button>
                                <button type="submit" id="btnlogin" disabled class="btn btn-primary">Login</button>
                            </div>
                            <script type="text/javascript">
                                function enableBtn(){
                                    document.getElementById("btnlogin").disabled = false;
                                }
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection