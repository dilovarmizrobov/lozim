@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Ваш заказ #{{ $order->id }} успешно создан!</h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-7 col-lg-6 mb-4">
                    @foreach($order->products as $product)
                        <div class="row border-bottom mx-0 py-2">
                            <div class="col"><a class="text-dark" href="{{ route('guest.product', $product->id) }}">{{ $product->name }}</a></div>
                            <div class="col-auto">{{ $product->pivot->quantity }} шт.</div>
                            <div class="col-auto">{{ $product->price }} с.</div>
                        </div>
                    @endforeach
                    <div class="row mx-0 py-2 font-weight-bold">
                        <div class="col-auto ml-auto">Итог:</div>
                        <div class="col-auto">{{ $order->total }} с.</div>
                    </div>
                </div>
                <div class="col-5 col-lg-6">
                    <p>Мы свяжемся с Вами в рабочее время пн-сб с 8:00 до 18:00 для подтверждения заказа.</p>
                    <p>Спасибо за покупки в нашем интернет-магазине!</p>
                </div>
            </div>
        </div>
    </section>
@endsection
