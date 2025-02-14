@extends('layouts.back.master')

@push('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('back/plugins/summernote/summernote-bs4.min.css')}}">
@endpush

@section('title', 'Ürün Oluştur')

@section('breadcrumb-title', 'Ürün Oluştur')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('back.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('back.product.index')}}">Ürünler</a></li>
    <li class="breadcrumb-item active">Ürün Oluştur</li>
@endsection

@section('content')
    <form action="{{route('back.product.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="card col">
                <div class="card-header">
                    <h3 class="card-title">Ürün Bilgileri</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="form-group col">
                            <label for="nameInput">Ürün Adı</label>
                            <input type="text" name="name" id="nameInput" class="form-control"
                                   placeholder="Kırmızı Tişört" value="{{old('name')}}">
                        </div>

                        <div class="form-group col">
                            <label for="slugInput">Seo Link</label>
                            <input type="text" name="slug" id="slugInput" class="form-control"
                                   placeholder="kirmizi-tisort" value="{{old('slug')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keywordInput">Seo Keywords</label>
                        <input type="text" name="seo_keywords" id="keywordInput" class="form-control"
                               placeholder="tişört, kırmızı, pamuklu" value="{{old('seo_keywords')}}">
                    </div>

                    <div class="form-group">
                        <label for="seoDescriptionInput">Seo Description</label>
                        <textarea class="form-control" name="seo_description" id="seoDescriptionInput" cols="30"
                                  placeholder="1.kalite pamuklu kırmızı tişört"
                                  rows="5">{!! old('seo_description') !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="categoryInput">Kategori</label>
                        <select name="category_id" id="categoryInput" class="form-control" required>
                            <option value="" selected disabled>Kategori Seçiniz</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">

                        <div class="form-group col">
                            <label for="stockInput">Stok</label>
                            <input type="number" name="stock" id="stockInput" class="form-control" placeholder="30"
                                   value="{{old('stock')}}">
                        </div>

                        <div class="form-group col">
                            <label for="unitPriceInput">Stok</label>
                            <input type="number" name="unit_price" id="unitPriceInput" class="form-control" step="0.05"
                                   placeholder="39.95" value="{{old('unit_price')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descriptionInput">Ürün Açıklaması</label>
                        <textarea name="description" id="descriptionInput" cols="30" rows="30"
                                  placeholder="Ürün açıklaması">{!! old('description') !!}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" checked name="status"
                               data-bootstrap-switch data-off-color="danger" data-on-color="success"
                               data-on-text="Aktif" data-off-text="Pasif">
                    </div>


                </div>
            </div>
        </div>

        <div class="row">
            <div class="card col">
                <div class="card-header">
                    <h3 class="card-title">Ürün Görselleri</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Görsel</th>
                            <th>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm add-image-btn"><i class="fa fa-plus"></i> Ekle</a>
                            </th>
                        </thead>

                        <tbody id="images-table-body">
                            <tr class="image-row">
                                <td>
                                    <input type="file" name="images[]" class="form-control fileInput">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger remove-button"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Oluştur
            </button>
        </div>

    </form>
@endsection

@push('js')
    <!-- Bootstrap Switch -->
    <script src="{{asset('back/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('back/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            // Summernote
            $('#descriptionInput').summernote({});

            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            $(".add-image-btn").click(function (){
                let tableRow = document.createElement("tr");
                tableRow.className = "image-row";

                let inputCol = document.createElement("td");
                let input = document.createElement("input");
                input.type = "file";
                input.name = "images[]";
                input.className = "form-control fileInput";

                inputCol.append(input);

                let buttonCol = document.createElement("td");
                let button = document.createElement("a");
                button.className = "btn btn-danger remove-button";

                let iconElement = document.createElement("i");
                iconElement.classList = "fa fa-times";

                button.append(iconElement);

                buttonCol.append(button);

                tableRow.append(inputCol);
                tableRow.append(buttonCol);

                $("#images-table-body").append(tableRow);
            });

            $(document).on('click', '.remove-button', function (e)
            {
                e.preventDefault();

                let row = $(this).parent().closest('.image-row');
                row.remove();

            });

        })

    </script>
@endpush










