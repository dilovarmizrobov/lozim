@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Мои заказы</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <header class="border-bottom mb-4 pb-3">
                <div class="row no-gutters">
                    @foreach($sorting_items as $item)
                        <div class="col-auto mr-2">
                            <a href="{{ route('customer.order.index', ['sort' => $item->slug]) }}" class="text-dark">{{ $item->sort_name }}</a>
                        </div>
                    @endforeach
                </div>
            </header>
            @forelse($orders as $order)
                <article class="card mb-5">
                    <header class="card-header">
                        <a href="#" class="float-right"><i class="fa fa-print"></i> @lang('Print')</a>
                        <strong class="d-inline-block text-dark mr-3">@lang('Order ID'): {{ $order->id }}</strong>
                        <span class="d-inline-block mr-3">@lang('Order Date'): {{ $order->date }}</span>
                        <strong>Статус: {{ $order->status->name }}</strong>
                    </header>
                    <div class="card-body border-bottom">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="text-muted">@lang('Delivery')</h6>
                                <p>
                                    Имя: {{ $order->name }} <br>
                                    Телефон: {{ $order->phone }} <br>
                                    Адрес: {{ $order->address }} <br>
                                    Комментарии к заказу: {{ $order->comment }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted">@lang('Payment')</h6>
                                <span class="text-success">Наличными</span>
                                <p>
                                    @lang('Subtotal'): {{ $order->total }} с. <br>
{{--                                    @lang('Shipping fee'):  5 с. <br>--}}
                                    <span class="b">@lang('Total'): {{ $order->total }} с. </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-hover">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Наименование</th>
                                <th scope="col" width="100">Цена</th>
                                <th scope="col" width="145">Количество</th>
                                <th scope="col" width="100">Сумма</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products()->limit(2)->get() as $product)
                                <tr>
                                    <td>
                                        <figure class="itemside">
                                            <div class="aside"><img src="{{ $product->image_medium }}" class="img-sm"></div>
                                            <figcaption class="info">
                                                <a href="#" class="title">{{ $product->name }}</a>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>
                                        <div class="price-wrap">
                                            <span class="price">{{ $product->price }} с.</span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $product->pivot->quantity }} шт.
                                    </td>
                                    <td>
                                        <div class="price-wrap">
                                            <span class="price">{{ $product->price * $product->pivot->quantity }} с.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mb-4">
                        <a href="{{ route('customer.order.show', $order->id) }}" class="btn btn-outline-primary">Открыть заказ</a>
                    </div>
                </article>
            @empty
                <div class="my-5 py-5 text-center">
                    <h3 class="mb-3">Ничего не найдено.</h3>
                    <a href="{{ route('guest.index') }}" class="btn btn-primary">Продолжить покупки</a>
                </div>
            @endforelse
        </div>
    </section>
@endsection
