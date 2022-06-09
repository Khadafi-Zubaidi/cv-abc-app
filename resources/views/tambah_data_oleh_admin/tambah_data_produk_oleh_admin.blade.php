@extends('masterlayout.master_layout_backend')
@section('content')
    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-dark">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Dashboard Administrator</a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="#" class="brand-link">
                    <span class="brand-text font-weight-light">Menu Utama</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{asset('foto_admin')}}/foto_admin.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama_admin}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('tampil_data_produk_oleh_admin')}}" class="nav-link">
                                    <i class="nav-icon fas fa-arrow-left"></i>
                                    <p>
                                        Sebelumnya
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <h1 class="m-0">Aplikasi Toko Gadget CV ABC</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Pemasukan Data Produk</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{route('simpan_data_produk_baru_oleh_admin')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <label>Kategori Produk *</label>
                                                    <div class="input-group mb-3">
                                                        <select name="id_kategori" class="form-control select2" style="width: 100%;">
                                                            @foreach($DataKategori as $dt1)
                                                                <option value="{{$dt1->id}}">{{$dt1->nama_kategori}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label>Satuan *</label>
                                                    <div class="input-group mb-3">
                                                        <select name="id_satuan" class="form-control select2" style="width: 100%;">
                                                            @foreach($DataSatuan as $dt2)
                                                                <option value="{{$dt2->id}}">{{$dt2->nama_satuan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label>Nama Produk *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk')}}">
                                                        @error('nama_produk')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <label>Jumlah Stok *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="jumlah_stok" class="form-control @error('jumlah_stok') is-invalid @enderror" value="{{ old('jumlah_stok')}}">
                                                        @error('jumlah_stok')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <label>Harga Satuan *</label><br>
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="harga_satuan" class="form-control @error('harga_satuan') is-invalid @enderror" value="{{ old('harga_satuan')}}">
                                                        @error('harga_satuan')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection
