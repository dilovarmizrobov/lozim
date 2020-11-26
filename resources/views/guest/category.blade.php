@extends('layout')

@section('content')
    <section class="bg-light py-2 mt-3">
        <div class="main-container">
            <div class="container-fluid">
                <nav>
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a class="text-dark" href="{{ route('guest.index') }}">Главная</a></li>
                        @foreach($array_breadcrumb as $breadcrumb)
                            @if($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                            @else
                                <li class="breadcrumb-item"><a class="text-dark" href="{{ route('guest.category', $breadcrumb['href']) }}">{{ $breadcrumb['title'] }}</a></li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
                <h4 class="title-page">{{ $category->name }}</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5 mt-2">
        <div class="container-fluid">
            <header class="border-bottom mb-4 pb-3">
                <div class="row no-gutters">
                    <div class="col-auto mr-2">
                        @if($sort === 'newly')
                            <span class="text-success">Новые</span>
                        @else
                            <a href="{{ route('guest.category', ['slug'=> request()->slug, 'sort' => 'newly']) }}" class="text-dark">Новые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'priceup')
                            <span class="text-success">Дешевые</span>
                        @else
                            <a href="{{ route('guest.category', ['slug'=> request()->slug, 'sort' => 'priceup']) }}" class="text-dark">Дешевые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'pricedown')
                            <span class="text-success">Дорогие</span>
                        @else
                            <a href="{{ route('guest.category', ['slug'=> request()->slug, 'sort' => 'pricedown']) }}" class="text-dark">Дорогие</a>
                        @endif
                    </div>
                </div>
            </header>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-4 col-lg-3">
                        <div href="#" class="card card-product-grid">
                            <a href="#" class="img-wrap"><img src="{{ $product->image_medium }}"></a>
                            <figcaption class="info-wrap">
                                <div class="fix-height">
                                    <a href="#" class="title">{{ $product->truncateName }}</a>
                                    <div class="price">{{ $product->price }} с.</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="counter mr-3">
                                        <input id="counter{{ $product->id }}" type="text" value="{{ $product->quantityInCart }}" class="counter__field js-counter__number" maxlength="4">
                                        <div class="counter__arrow-block" role="group">
                                            <span class="counter__arrow js-counter__plus" data-counter="#counter{{ $product->id }}"></span>
                                            <span class="counter__arrow counter__arrow-down js-counter__minus" data-counter="#counter{{ $product->id }}"></span>
                                        </div>
                                    </div>
                                    <div class="mr-3">
                                        <button class="btn btn-sm btn-block btn-outline-primary js-product-tocart" data-url="{{ route('cart.add') }}" data-counter="#counter{{ $product->id }}" data-product-id="{{ $product->id }}">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-block btn-outline-primary js-product-tofavorite" data-url="{{ route('customer.favorite.toggle', $product->id) }}">
                                            @if($product->isFavorite)
                                                <i class="fas fa-heart"></i>
                                            @else
                                                <i class="far fa-heart"></i>
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </figcaption>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
