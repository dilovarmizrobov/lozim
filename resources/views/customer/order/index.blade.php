@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Мои заказы</h4>
            </div>
        </div>
    </section>
    <section class="main-container">
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
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                @forelse($orders as $order)
                    <div class="col-lg-6">
                        <article class="card mb-5 shadow">
                            <header class="card-header d-flex justify-content-between">
                                <strong>@lang('Order Date'): {{ $order->date }}</strong>
                                <span>Статус: {{ $order->status->name }}</span>
                            </header>
                            <div class="card-body border-bottom">
                                <h6 class="text-muted">@lang('Payment'): <span class="text-success">Наличными</span></h6>
                                <p>
                                    @lang('Subtotal'): {{ $order->total }} с. <br>
                                    {{ $order->delivery_type }}:  {{ $order->delivery_price }} с. <br>
                                    <strong>@lang('Total'): {{ $order->general_total }} с. </strong>
                                </p>
                            </div>
                            <div class="table-responsive table-hover">
                                <table class="table table-borderless table-shopping-cart">
                                    <thead class="text-muted">
                                    <tr class="small text-uppercase">
                                        <th scope="col">ТОВАР</th>
                                        <th scope="col" width="145">Кол-во / Цена</th>
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
                                                        <a href="{{ route('guest.product', $product->id) }}" class="title">{{ $product->name }}</a>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>{{ $product->pivot->quantity }} <i class="las la-times" style="font-size: 12px"></i> {{ $product->price }} с.</td>
                                            <td>{{ $product->price * $product->pivot->quantity }} с.</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mb-4">
                                <a href="{{ route('customer.order.show', $order->id) }}" class="btn btn-outline-primary">Подробнее</a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col">
                        <div class="my-5 py-5 text-center">
                            <h3 class="mb-3">Ничего не найдено.</h3>
                            <a href="{{ route('guest.index') }}" class="btn btn-primary">Продолжить покупки</a>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $orders->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
