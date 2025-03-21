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
                            <td>
                                <input type="checkbox" {{$category->status ? 'checked' : ''}} name="status"
                                       data-bootstrap-switch data-off-color="danger" data-on-color="success"
                                       data-on-text="Aktif" data-off-text="Pasif" data-id="{{$category->id}}">
                            </td>
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
    <!-- Bootstrap Switch -->
    <script src="{{asset('back/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
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

        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        $("input[data-bootstrap-switch]").on('switchChange.bootstrapSwitch', function () {
            let id = $(this).data('id');
            let url = "{{route('back.category.statusUpdate', 'catID')}}".replace('catID', id);
            $.ajax({
                method: "POST",
                url: url,
                headers: {
                    "X-CSRF-TOKEN" : "{{csrf_token()}}"
                },
                success : function (resp)
                {
                    alert("Güncellendi");
                },
                error: function(resp)
                {
                    alert("Bir hata oluştu.");
                }
            });
        });
    </script>
@endpush











