@extends('layouts.back.master')

@push('css')
@endpush

@section('title', 'Kategori Oluştur')

@section('breadcrumb-title', 'Kategori Oluştur')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('back.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('back.category.index')}}">Kategoriler</a></li>
    <li class="breadcrumb-item active">Kategori Oluştur</li>
@endsection

@section('content')
    <div class="row">
        <div class="card col">
            <div class="card-header">
                <h3 class="card-title">Kategori Oluştur</h3>
            </div>

            <div class="card-body">
                <form action="{{route('back.category.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="nameInput">Kategori Adı</label>
                        <input type="text" name="name" id="nameInput" class="form-control" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="slugInput">Sef Link</label>
                        <input type="text" name="slug" id="slugInput" class="form-control" value="{{old('slug')}}">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" checked name="status"
                               data-bootstrap-switch data-off-color="danger" data-on-color="success"
                               data-on-text="Aktif" data-off-text="Pasif">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Bootstrap Switch -->
    <script src="{{asset('back/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
@endpush










