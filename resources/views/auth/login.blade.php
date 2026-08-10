@extends('layouts.auth')
@section('title', 'login')

@section('content')
<div class="login-box">
    <div class="card card-outline card-primary" >
        <div class="card-header text-center">
            <img class="logo mb-2" src="{{ asset('image/smk.png') }}" style="width: 40%"><br>
            <a href="#" class="h1"><b>E-</b>Arsip</a>
            <h5>SMK Negeri 1 Tanjung Palas</h5>

        </div>
        <div class="card-body">

            <form id="quickForm" action="login" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" >
                    @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                    </span>
                    @endif
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" >
                    
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                    </span>
                    @endif
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>


@endsection