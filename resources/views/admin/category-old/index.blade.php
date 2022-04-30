@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row my-4 align-items-center">
            <div class="col-auto">
                <h3 class="font-weight-normal">
                    <a class="text-dark" href="{{ route('admin.categories.index') }}">Каталог</a>
                </h3>
            </div>
        </div>
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @elseif(session()->get('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="mb-3 border py-2 px-3">
            <div class="cat-menu" data-menu-id="0">
                <div class="row no-gutters mb-3 align-items-center">
                    <div class="col-auto">
                        <h4 class="font-weight-normal">
                            Все категории
                        </h4>
                    </div>
                    <div class="col-auto ml-3">
                        <a type="button" class="btn btn-sm btn-outline-dark" href="{{ route('admin.categories.create', ['parent_id'=>'null']) }}">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                @foreach($categories->getIndexCategories() as $category)
                    <div class="row no-gutters mb-3 align-items-center">
                        <div class="col-auto mr-3">
                            <button class="btn btn-outline-dark cat-next-menu" data-next-menu-id="{{ $category->id }}" data-menu-id="0">{{ $category->name }}</button>
                        </div>
                        <div class="col-auto">
                            <form action="{{ route('admin.categories.destroy', $category->id)}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                                    <a type="button" class="btn btn-outline-dark" href="{{ route('admin.categories.edit', $category->id) }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button type="submit" class="btn btn-outline-dark">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            @foreach($categories->all() as $category)
                <div class="cat-menu" data-menu-id="{{ $category->id }}" style="display: none">
                        <div class="row no-gutters mb-3 align-items-center">
                            <div class="col-auto">
                                <button class="btn btn-sm cat-prev-menu" data-menu-id="{{ $category->id }}" data-prev-menu-id="{{ $category->parent ? $category->parent->id : 0 }}">
                                    <span class="fas fa-arrow-left"></span>
                                </button>
                            </div>
                            <div class="col-auto ml-2">
                                <h4 class="font-weight-normal">
                                    {{ $category->name }}
                                </h4>
                            </div>
                            <div class="col-auto ml-3">
                                <a type="button" class="btn btn-sm btn-outline-dark" href="{{ route('admin.categories.create', ['parent_id'=>$category->id]) }}">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        @foreach($category->children as $children)
                            <div class="row no-gutters mb-3 align-items-center">
                                <div class="col-auto mr-3">
                                    <button class="btn btn-outline-dark cat-next-menu" data-next-menu-id="{{ $children->id }}" data-menu-id="{{ $category->id }}">{{ $children->name }}</button>
                                </div>
                                <div class="col-auto">
                                    <form action="{{ route('admin.categories.destroy', $children->id)}}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                                            <a type="button" class="btn btn-outline-dark" href="{{ route('admin.categories.edit', $children->id) }}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="submit" class="btn btn-outline-dark">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
            @endforeach
        </div>
    </div>
    <script>
        window.onload = function () {
            $('.cat-next-menu').click(function (e) {
                let self = $(this);
                $(".cat-menu[data-menu-id=" + self.data().menuId + "]").fadeOut(0),
                $(".cat-menu[data-menu-id=" + self.data().nextMenuId + "]").fadeIn();
            });

            $('.cat-prev-menu').click(function (e) {
                let self = $(this);
                $(".cat-menu[data-menu-id=" + self.data().menuId + "]").fadeOut(0);
                $(".cat-menu[data-menu-id=" + self.data().prevMenuId + "]").fadeIn();
            });
        }
    </script>
@endsection
