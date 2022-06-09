@extends('masterlayout.master_layout_backend')
@section('content')
    <body class="hold-transition layout-top-nav layout-navbar-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="#" class="navbar-brand">
                        <span class="brand-text font-weight-light">Aplikasi Toko Gadget CV. ABC</span>
                    </a>
                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
            <div class="content-wrapper" style="background-color: white">
                <div class="content-header">
                    <div class="container">
                      <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0"> Produk <small></small></h1>
                        </div><!-- /.col -->
                      </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <div class="content">
                    <div class="container">
                        <div class="row">
                            @foreach($DaftarProduk as $dp)
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title m-0">{{$dp->nama_kategori}}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div align="center">
                                                <img src="{{asset('foto_produk')}}/{{$dp->foto_produk}}" width="256px" height="256px">
                                                &nbsp;
                                            </div>
                                            <h4>{{$dp->nama_produk}}</h4><br>
                                            <h5 class="card-title m-0">Harga : Rp. {{number_format($dp->harga_satuan,0,",",".")}}</h5><br>
                                            <h5 class="card-title m-0">Stok {{$dp->jumlah_stok}} {{$dp->nama_satuan}}</h5><br>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
              Dikembangkan oleh SMKN 1 Taliwang 
            </div>
            <!-- Default to the left -->
            <strong>Template by <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
@endsection