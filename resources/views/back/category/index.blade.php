@extends('layouts.back.master')

@push('css')
@endpush

@section('title', 'Kategoriler')

@section('breadcrumb-title', 'Kategoriler')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('back.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kategoriler</li>
@endsection

@section('content')
    <div class="row">
        <div class="card col">
            <div class="card-header">
                <h3 class="card-title">Tüm Kategoriler</h3>

                <div class="card-tools">
                    <a href="{{route('back.category.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>
                        Oluştur</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Sef Link</th>
                    <th>Durum</th>
                    <th width="150px">İşlemler</th>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->status}}</td>
                            <td>
                                <a href="{{route('back.category.edit', $category->id)}}" class="btn btn-warning"><i
                                        class="fa fa-pen"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger delete-button"
                                   data-id="{{$category->id}}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
            <span class="float-right">
                {{$categories->links()}}
            </span>
            </div>
        </div>
    </div>

    <form method="POST" class="d-none" id="delete-form">
        @csrf
        @method("DELETE")
    </form>
@endsection

@push('js')
    <script>
        $(function () {
            $('.delete-button').click(function () {
                let id = $(this).data('id');
                let url = "{{route('back.category.destroy', 'categoryID')}}".replace('categoryID', id);
                let form = $('#delete-form');
                form.attr('action', url);
                form.submit();
            });
        });
    </script>
@endpush










