@extends('masterlayout.master_layout_backend')
@section('content')
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>Register</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Register User Aplikasi</p>
                    <form action="{{route('simpan_data_user_baru')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Email User</label>
                            <input type="email" name="email_user" class="form-control @error('email_user') is-invalid @enderror" placeholder="Masukkan Email User" value="{{old('email_user')}}">
                            @error('email_user')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" name="nama_user" class="form-control @error('nama_user') is-invalid @enderror" placeholder="Masukkan Nama User" value="{{old('nama_user')}}">
                            @error('nama_user')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" value="{{old('password')}}">
                            @error('password')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection