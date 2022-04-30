@extends('admin.layout')

@section('content')
    <div class="container product-create">
        <div class="row my-4 align-items-center">
            <div class="col-auto">
                <h4 class="text-center font-weight-normal">Создание продукта</h4>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-outline-primary">Назад</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <form class="formsValidate" action="{{ route('admin.product.store') }}" method="post"
                                                                            enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}
                    @if(!is_null($category))
                        <div class="form-group row">
                            <div class="col-auto">
                                <span class="fz-17">Категория <span class="font-weight-bold">{{ $category->name }}</span></span>
                            </div>
                            <div class="col-auto ml-auto">
                                <a data-toggle="collapse" href="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">Редактировать</a>
                            </div>
                        </div>
                    @else
                        <div class="form-group row">
                            <div class="col-auto">
                                <span class="fz-17">Категория</span>
                            </div>
                        </div>
                    @endif
                    <div class="form-group collapse{{ is_null($category) ? ' show' : '' }}" id="collapseCategories">
                        <div class="border px-3 py-3 shadow rounded">
                            <div class="pcat-menu" data-menu-id="0">
                                <div class="pc-category-title font-weight-light">Категория</div>
                                @foreach($categories->getIndexCategories() as $category_item)
                                    @if($category_item->children->isEmpty())
                                        <div class="pc-category-item">
                                            <a href="{{ route('admin.product.create', ['category_id' => $category_item->id]) }}">{{ $category_item->name }}</a>
                                        </div>
                                    @else
                                        <div class="pc-category-item pcat-next-menu" data-next-menu-id="{{ $category_item->id }}" data-menu-id="0">
                                            <span>{{ $category_item->name }}</span>
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @foreach($categories->all() as $category_item)
                                @if(!$category_item->children->isEmpty())
                                    <div class="pcat-menu" data-menu-id="{{ $category_item->id }}" style="display: none">
                                        <div class="pc-category-title font-weight-light pcat-prev-menu" data-menu-id="{{ $category_item->id }}" data-prev-menu-id="{{ $category_item->parent ? $category_item->parent->id : 0 }}">
                                            <i class="ti-angle-left"></i>
                                            <span>{{ $category_item->name }}</span>
                                        </div>
                                        @foreach($category_item->children as $children)
                                            @if($children->children->isEmpty())
                                                <div class="pc-category-item">
                                                    <a href="{{ route('admin.product.create', ['category_id' => $children->id]) }}">{{ $children->name }}</a>
                                                </div>
                                            @else
                                                <div class="pc-category-item pcat-next-menu" data-menu-id="{{ $category_item->id }}" data-next-menu-id="{{ $children->id }}">
                                                    <span>{{ $children->name }}</span>
                                                    <i class="ti-angle-right"></i>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <input class="form-control d-none" name="category_id" value="{{ $category->id ?? false }}"
                               checked type="radio" required>
                        <div class="invalid-feedback font-weight-bold">Выберите категорию</div>
                        @if ($errors->has('category_id'))
                            <span class="font-weight-bold small">{{ $errors->first('category_id') }}</span>
                        @endif
                    </div>
                    @if(!is_null($category))
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="inputName">Название</label>
                            </div>
                            <div class="col-lg-8">
                                <input name="name" value="{{ old('name') }}" type="text" class="form-control form-control-sm" id="inputName" required>
                            </div>
                            <div class="col">
                                @if ($errors->has('name'))
                                    <span class="font-weight-bold text-danger small">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="inputPrice">Цена</label>
                            </div>
                            <div class="col-lg-8">
                                <input name="price" value="{{ old('price') }}" type="text" class="form-control form-control-sm" id="inputPrice" required>
                            </div>
                            <div class="col">
                                @if ($errors->has('price'))
                                    <span class="font-weight-bold small">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="inputDescription">Описание</label>
                            </div>
                            <div class="col-lg-8">
                                <textarea name="description" class="form-control form-control-sm" id="inputDescription" rows="8" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="col">
                                @if ($errors->has('description'))
                                    <span class="font-weight-bold small">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-2">
                                <label>Фотографии</label>
                            </div>
                            <div id="dzImage" class="ml-2" data-img-limit="{{ $image_limit }}">
                                <div class="small mb-1">основное фото</div>
                                <div class="dzImage-wrap">
                                    <div class="item item-add">
                                        <div class="uploader">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                        <div class="loader spinner-grow" role="status" style="display: none">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <input id="inputImagesBuffer" type="file" accept="image/*" multiple="true" hidden>
                                <input name="images" id="inputImages" type="text" hidden>
                                <small class="form-text text-muted">Пожалуйста, загрузите действительный файл изображения. Размер изображения не должен превышать 10 МБ.</small>
                                <span class="errors font-weight-bold text-danger small"></span>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button class="btn btn-sm btn-primary shadow" type="submit">Создать</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () {
            $('.pcat-next-menu').click(function (e) {
                let self = $(this);
                $(".pcat-menu[data-menu-id=" + self.data().menuId + "]").fadeOut(0),
                    $(".pcat-menu[data-menu-id=" + self.data().nextMenuId + "]").fadeIn();
            });

            $('.pcat-prev-menu').click(function (e) {
                let self = $(this);
                $(".pcat-menu[data-menu-id=" + self.data().menuId + "]").fadeOut(0);
                $(".pcat-menu[data-menu-id=" + self.data().prevMenuId + "]").fadeIn();
            });
        }
    </script>
@endsection
