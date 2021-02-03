@extends('wp.layout.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Beranda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('index') }}">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('data_file/logo.png') }}" class="img img-responsive">
                <h3>Pemerintah Kabupaten Pekalongan, Jawa Tengah</h3>
                <h4 style="margin-top: -10px">Badan Pengelola Keuangan Daerah</h4>
                <h5 style="margin-top: -10px">Jl. Sindoro No.7 Kajen</h5>
            </div>
        </div>
        <!-- /.row -->
        @if (empty(session('login_wp')))
        <h3 class="text-center mt-5 mb-5">Untuk memulai pendaftaran BPHTB anda harus memiliki akun BPHTB</h3>
        <div class="row justify-content-md-center">
            <div class="col-lg-4 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4>Belum punya akun?</h4>
                        <p>Klik di sini untuk mendaftar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4>Sudah punya akun?</h4>
                        <p>Klik di sini untuk login</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        @else
        <h3 class="text-center mt-5 mb-5">Selamat datang {{ session('nama_wp') }}</h3>
        <div class="row justify-content-md-center">
            <div class="col-lg-4 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4>Belum mendaftar BPHTB?</h4>
						<p>Klik di sini untuk mendaftar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4>Sudah pernah mendaftar BPHTB?</h4>
						<p>Klik di sini untuk melihat data</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        @endif
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection