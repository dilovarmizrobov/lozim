@extends('layout')

@section('content')
    <section class="p-3 m-3">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">@lang('Order ID'): #{{ $order->id }}</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            @if($order->isNewOrder)
                <div class="alert alert-success mb-4" role="alert">
                    <h5 class="title-page">Ваш заказ успешно создан!</h5>
                    Мы свяжемся с Вами в рабочее время пн-сб с 9:00 до 18:00 для подтверждения заказа.<br>
                    Спасибо за покупки в нашем интернет-магазине!
                </div>
            @endif
            <article class="card">
                <header class="card-header">
{{--                    <a href="#" class="float-right"><i class="fa fa-print"></i> @lang('Print')</a>--}}
                    <span class="d-inline-block mr-3">@lang('Order Date'): {{ $order->created_at }}</span>
                    <strong class="float-right">Статус: {{ $order->status->name }}</strong>
                </header>
                <div class="card-body border-bottom">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="text-muted">@lang('Delivery')</h6>
                            <p>
                                Имя: {{ $order->name }} <br>
                                Телефон: {{ $order->phone }} <br>
                                Адрес: {{ $order->address }} <br>
                                Дата доставки: {{ $order->delivery_date }}<br>
                                Комментарии к заказу: {{ $order->comment }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">@lang('Payment')</h6>
                            <span class="text-success">Наличными</span>
                            <p>
                                @lang('Subtotal'): {{ $order->total }} с. <br>
                                {{ $order->delivery_type }}: {{ $order->delivery_price }} с. <br>
                                <span class="b">@lang('Total'): {{ $order->general_total }} с. </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-hover">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                        <tr class="small text-uppercase">
                            <th scope="col">ТОВАР</th>
                            <th scope="col" width="100">Цена</th>
                            <th scope="col" width="100">Кол-во</th>
                            <th scope="col" width="100">Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            <tr>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img src="{{ $product->image_medium }}" class="img-sm" alt="img"></div>
                                        <figcaption class="info">
                                            <a href="{{ route('guest.product', $product->id) }}" class="title title-link">{{ $product->name }}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>{{ $product->price }} с.</td>
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
            </article>
            <div class="mt-5 d-flex justify-content-center">
                <button class="btn btn-primary">Повторить заказ</button>
            </div>
        </div>
    </section>
@endsection
