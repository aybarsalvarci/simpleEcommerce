@extends('layouts.auth.master')

@section('title', 'Şifremi Unuttum')

@push('css') @endpush

@section('content')

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Şifreni mi unuttun? Şifre sıfırlama bağlantısı gönderelim.</p>

            <form action="{{route('password.request')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Bağlantı Gönder</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{route('login')}}">Giriş Yap</a>
            </p>
            <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">Üye Ol</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>

@endsection

@push('js') @endpush
