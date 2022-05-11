@extends('layout')

@section('content')
<section class="main-container">
        <div class="container-fluid">
            <h4 class="title-page my-3 py-3">Избранные товары</h4>
            <div class="card mb-5">
                <table class="table table-borderless table-shopping-cart">
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside">
                                            <img src="{{ $product->image_medium }}" class="img-sm">
                                        </div>
                                        <figcaption class="info">
                                            <a href="{{ route('guest.product', $product->id) }}" class="title title-link">{{ $product->name }}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <span class="price">{{ $product->price }} с.</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="counter mr-3">
                                            <input id="counter{{ $product->id }}" type="text" value="{{ $product->quantityInCart }}" class="counter__field js-counter__number" maxlength="4">
                                            <div class="counter__arrow-block" role="group">
                                                <span class="counter__arrow js-counter__plus" data-counter="#counter{{ $product->id }}"></span>
                                                <span class="counter__arrow counter__arrow-down js-counter__minus" data-counter="#counter{{ $product->id }}"></span>
                                            </div>
                                        </div>
                                        <div class="mr-3">
                                            <button class="btn btn-sm btn-block {{ $product->available ? "btn-outline-primary" : "btn-outline-danger" }} js-product-tocart" {{ $product->available ? null : "disabled" }} data-url="{{ route('cart.add') }}" data-counter="#counter{{ $product->id }}" data-product-id="{{ $product->id }}">
                                                @if($product->inCart)
                                                    <i class="fas la-sm fa-shopping-cart"></i>
                                                @else
                                                    <i class="la la-lg la-shopping-cart"></i>
                                                @endif
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
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="99">
                                    <div class="my-5 py-5 text-center">
                                        <h6 class="mb-3 font-weight-normal">Ничего не найдено</h6>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
