@extends('layout')

@section('content')
    <section class="p-3 my-3">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Корзина</h3>
            </div>
        </div>
    </section>
    <section class="section-content padding-y">
        <div class="main-container">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(Cart::content()->isNotEmpty())
                    <div class="card">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col">Товар</th>
                                    <th scope="col" width="100">Цена</th>
                                    <th scope="col" width="145">Количество</th>
                                    <th scope="col" width="100">Сумма</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach (Cart::content() as $product)
                                <tr>
                                    <td>
                                        <figure class="itemside">
                                            <div class="aside"><img src="{{ $product->model->image_medium }}" class="img-sm"></div>
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
                                            <div class="counter mr-2">
                                                <input id="counter{{ $product->id }}" type="text" value="{{ $product->model->quantityInCart }}" class="counter__field js-counter__number" maxlength="4">
                                                <div class="counter__arrow-block" role="group">
                                                    <span class="counter__arrow js-counter__plus" data-counter="#counter{{ $product->id }}"></span>
                                                    <span class="counter__arrow counter__arrow-down js-counter__minus" data-counter="#counter{{ $product->id }}"></span>
                                                </div>
                                            </div>
                                            <div class="mr-2">
                                                <button class="btn btn-sm btn-block btn-outline-primary js-product-edit-count-in-cart" data-url="{{ route('cart.add') }}" data-counter="#counter{{ $product->id }}" data-product-id="{{ $product->id }}" data-price="{{ $product->price }}" data-subtotal-href="#js-product-subtotal-{{ $product->id }}">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-block btn-outline-primary js-product-tofavorite" data-url="{{ route('customer.favorite.toggle', $product->id) }}">
                                                    @if($product->model->isFavorite)
                                                        <i class="fas fa-heart"></i>
                                                    @else
                                                        <i class="far fa-heart"></i>
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price-wrap">
                                            <span class="price"><span id="js-product-subtotal-{{ $product->id }}">{{ $product->price * $product->qty }}</span> с.</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('cart.remove', $product->rowId) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="las la-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-body border-top">
                            <div class="d-flex pt-2">
                                <h5 class="mr-3 ml-auto">Сумма заказов:</h5>
                                <h5><span class="header_total_price">{{ Cart::subtotal() }}</span> с.</h5>
                            </div>
                            <div class="d-flex pb-4 pt-2 align-items-center">
                                <span class="ml-auto">
                                    <button class="btn btn-sm" data-toggle="popover" data-placement="left" data-trigger="focus" data-content="Бесплатная доставка при заказе свыше {{ $delivery_from }} сомони."><i class="fas fa-info-circle"></i></button>
                                </span>
                                <span class="mr-2">Доставка:</span>
                                <span class="font-weight-bold">
                                    <span class="freeShipping{{ $hasFreeShipping ? '' : ' d-none' }}">бесплатно.</span>
                                    <span class="paidShipping{{ !$hasFreeShipping ? '' : ' d-none' }}">{{ $delivery_price }} с.</span>
                                </span>
                            </div>
                            <div>
                                <a href="{{ route('customer.checkout.index') }}" class="btn btn-primary float-md-right">
                                    <span>Оформить заказ</span>
                                    <i class="fa fa-xs fa-chevron-right"></i>
                                </a>
                                <a href="{{ route('guest.index') }}" class="btn btn-light border">
                                    <i class="fa fa-xs fa-chevron-left"></i>
                                    <span>Продолжить покупки</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-success mt-3 mb-5">
                        <p class="icontext"><i class="icon text-success fa fa-truck"></i> Бесплатная доставка при заказе свыше {{ $delivery_from }} сомони.</p>
                    </div>
                @else
                    <div class="my-5 py-5 text-center">
                        <h4 class="mb-3">Ваша корзина пуста!</h4>
                        <a href="{{ route('guest.index') }}" class="btn btn-sm btn-primary">Продолжить покупки</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
