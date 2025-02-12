@extends('layouts.back.master')

@push('css')
@endpush

@section('title', 'Kategori Düzenle')

@section('breadcrumb-title', 'Kategori Düzenle')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('back.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('back.category.index')}}">Kategoriler</a></li>
    <li class="breadcrumb-item active">Kategori Düzenle</li>
@endsection

@section('content')
    <div class="row">
        <div class="card col">
            <div class="card-header">
                <h3 class="card-title">Kategori Düzenle</h3>
            </div>

            <div class="card-body">
                <form action="{{route('back.category.update', $category->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nameInput">Kategori Adı</label>
                        <input type="text" name="name" id="nameInput" class="form-control" value="{{$category->name}}">
                    </div>

                    <div class="form-group">
                        <label for="slugInput">Sef Link</label>
                        <input type="text" name="slug" id="slugInput" class="form-control" value="{{$category->slug}}">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" {{$category->status ? 'checked' : ''}} name="status"
                               data-bootstrap-switch data-off-color="danger" data-on-color="success"
                               data-on-text="Aktif" data-off-text="Pasif">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Düzenle</button>
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










