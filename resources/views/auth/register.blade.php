@extends('layouts.auth.master')

@section('title', 'Giriş Yap')

@push('css')

@endpush

@section('content')

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="input-group mb-3">
                    <div class="text-center">
                        <img src="{{asset('images/default-user.png')}}"
                             class="avatar img-circle img-thumbnail" alt="avatar" width="200px">
                        <h6>Farklı bir görsel yükle</h6>
                        <input type="file" class="text-center center-block file-upload" name="image">
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Ad Soyad" name="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Şifre" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Şifre tekrar" name="password_confirmation">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Kaydol</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    Sign up using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Sign up using Google+
                </a>
            </div>

            <a href="{{route('login')}}" class="text-center">Zaten Üyeyim</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
@endsection

@push('js')
    <script>
        $(document).ready(function () {


            let readURL = function (input) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function () {
                readURL(this);
            });
        });
    </script>
@endpush
