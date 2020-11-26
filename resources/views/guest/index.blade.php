@extends('layout')

@section('content')
    <div class="main-container">
        <section class="container-fluid my-5">
            <header class="section-heading">
                <a href="#" class="btn btn-outline-primary float-right">See all</a>
                <h4 class="section-title">Popular products</h4>
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
        </section>
    </div>
@endsection
