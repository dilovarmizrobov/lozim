@extends('layout')

@section('content')
    <section class="bg-light py-2 mt-3">
        <div class="main-container">
            <div class="container-fluid">
                <nav>
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a class="text-dark" href="{{ route('guest.index') }}">Главная</a></li>
                        @foreach($array_breadcrumb as $breadcrumb)
                            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('guest.category', $breadcrumb['href']) }}">{{ $breadcrumb['title'] }}</a></li>
                        @endforeach
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
                <h4 class="title-page">{{ $product->name }}</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5 mt-3">
        <section class="container-fluid">
            <div class="card">
                <div class="row no-gutters">
                    <aside class="col-5">
                        <div id="carouselProductCaptions" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($product->product_images as $image)
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <img src="{{ $image->imageMediumUrl }}" class="d-block w-100" alt="...">
                                    </div>
                                @endforeach
                            </div>
                            @if($product->product_images->count() > 1)
                                <a class="carousel-control-prev" href="#carouselProductCaptions" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselProductCaptions" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            @endif
                        </div>
                    </aside>
                    <main class="col border-left">
                        <article class="content-body">
                            <div class="rating-wrap my-3">
                                <small class="label-rating">Арт. <span class="font-weight-bold">{{ $product->id }}</span></small>
                                <br>
                                @if($product->available)
                                    <small class="label-rating text-success"><i class="fa fa-clipboard-check"></i> В наличии</small>
                                @else
                                    <small class="label-rating text-danger"><i class="fa fa-clipboard-check"></i> Нет в наличии</small>
                                @endif
                            </div>
                            <div class="mb-3">
                                <var class="price h4">{{ $product->price }}</var>
                                <span class="text-muted">cомони</span>
                            </div>
                            <p>{{ $product->description }}</p>
                            <hr>
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
                                        В корзину
                                    </button>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-block btn-outline-primary js-product-tofavorite" data-url="{{ route('customer.favorite.toggle', $product->id) }}">
                                        @if($product->isFavorite)
                                            <i class="fas fa-heart"></i>
                                        @else
                                            <i class="far fa-heart"></i>
                                        @endif
                                            В избранное
                                    </button>
                                </div>
                            </div>
                        </article>
                    </main>
                </div>
            </div>
        </section>
        <section class="container-fluid my-5">
            <header class="section-heading">
                <h4 class="section-title">Related products</h4>
            </header>
            <div class="row">
                @foreach($mightAlsoLike as $product)
                    <div class="col-4 col-lg-3">
                        @include('product.middle')
                    </div>
                @endforeach
            </div>
        </section>
    </section>
@endsection
