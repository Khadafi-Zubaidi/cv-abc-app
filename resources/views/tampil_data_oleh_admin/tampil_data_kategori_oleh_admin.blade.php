@extends('masterlayout.master_layout_backend')
@section('content')
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
                            <img src="{{asset('foto_admin')}}/foto_admin.png" class="img-circle elevation-2" alt="Foto Admin">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{$LoggedUserInfo->nama_admin}}</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('tambah_data_kategori_oleh_admin')}}" class="nav-link">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>
                                        Tambah Data
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('dashboard_admin')}}" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Kembali ke Dashboard
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
                                        <h5 class="card-title">Data Kategori Produk</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @csrf
                                                <table id="tampilan_tabel" class="table table-bordered table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Kategori</th>
                                                            <th colspan="2">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach($DataTabel as $dt)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$dt->nama_kategori}}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="ubahData({{$dt->id}})" class="btn btn-warning btn-block btn-sm"><i class="fa fa-edit"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" onclick="hapusData({{$dt->id}})" class="btn btn-danger btn-block btn-sm"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                            <!-- Ubah Data -->
                                                            <div class="modal fade" id="Modal1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Ubah Data Kategori</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="Form1" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id1"/>
                                                                                <label>Nama Kategori *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_kategori1" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-success btn-block">Simpan Perubahan Data</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function ubahData(id)
                                                                {
                                                                    $.get('/cari_id_kategori/'+id,function(data){
                                                                        $("#id1").val(data.id);
                                                                        $("#nama_kategori1").val(data.nama_kategori);
                                                                        $("#Modal1").modal('toggle');
                                                                    })
                                                                    $("#Form1").submit(function (e){
                                                                        e.preventDefault();
                                                                        let id = $("#id1").val();
                                                                        let nama_kategori = $("#nama_kategori1").val();
                                                                        let _token = $("input[name=_token]").val();
                                                                        $.ajax({
                                                                            url:"{{route('kategori.simpan_perubahan_data')}}",
                                                                            type: "PUT",
                                                                            data:{
                                                                                id:id,
                                                                                nama_kategori:nama_kategori,
                                                                                _token:_token
                                                                            },
                                                                            success: (response) => {
                                                                                if (response) {
                                                                                    this.reset();
                                                                                    alert('Perubahan data telah disimpan');
                                                                                    $("#Modal1").modal('hide');
                                                                                    window.location = "{{route('tampil_data_kategori_oleh_admin')}}";
                                                                                }
                                                                            },
                                                                            error: function(response){
                                                                                console.log(response);
                                                                                alert('Nama Kategori telah ada');
                                                                            }
                                                                        })
                                                                    })
                                                                }
                                                            </script>
                                                            <!-- Hapus Data -->
                                                            <div class="modal fade" id="Modal2">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Hapus Data</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="Form2" action="" method="post">
                                                                                @csrf
                                                                                <input type="hidden" id="id2"/>
                                                                                <label>Nama Kategori *</label><br>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" id="nama_kategori2" class="form-control" disabled>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <button type="submit" class="btn btn-success btn-block">Hapus Data</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                function hapusData(id)
                                                                {
                                                                    $.get('/cari_id_kategori/'+id,function(data){
                                                                        $("#id2").val(data.id);
                                                                        $("#nama_kategori2").val(data.nama_kategori);
                                                                        $("#Modal2").modal('toggle');
                                                                    })
                                                                    $("#Form2").submit(function (e){
                                                                        e.preventDefault();
                                                                        bootbox.confirm("Anda yakin mau hapus data ini ?", function(result){
                                                                            if(result){
                                                                                let id = $("#id2").val();
                                                                                let _token = $("input[name=_token]").val();
                                                                                $.ajax({
                                                                                    url:"{{route('kategori.hapus_data')}}",
                                                                                    type: "PUT",
                                                                                    data:{
                                                                                        id:id,
                                                                                        _token:_token
                                                                                    },
                                                                                    success:function(response){
                                                                                            $("#Modal2").modal('hide');
                                                                                            window.location = "{{route('tampil_data_kategori_oleh_admin')}}";
                                                                                    }
                                                                                })
                                                                            }
                                                                        });
                                                                            
                                                                    })
                                                                }
                                                            </script>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
