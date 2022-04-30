@extends('layout')

@section('content')
    <section class="m-3 p-3">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Мои заказы</h4>
            </div>
        </div>
    </section>
    <section class="main-container">
        <div class="container-fluid">
            <header class="pb-3">
                <div class="row no-gutters">
                    @foreach($sorting_items as $item)
                        <div class="col-auto mr-3">
                            @if($sort === $item->slug)
                                <a href="{{ route('customer.order.index') }}" class="text-primary">{{ $item->name }}</a>
                            @else
                                <a href="{{ route('customer.order.index', ['sort' => $item->slug]) }}" class="title-link">{{ $item->name }}</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </header>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">@lang('Order Date')</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Дата доставки</th>
                        <th scope="col">Товары</th>
                        <th scope="col">Доставка</th>
                        <th scope="col">Итого</th>
                        <th scope="col">@lang('Payment')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>
                                <a href="{{ route('customer.order.show', $order->id) }}" class="text-primary">{{ $order->created_at }}</a>
                            </td>
                            <td >{{ $order->status->name }}</td>
                            <td>{{ $order->delivery_date }}</td>
                            <td>{{ $order->total }} с.</td>
                            <td>{{ $order->delivery_price }} с.</td>
                            <td>{{ $order->general_total }} с.</td>
                            <td>Наличными</td>
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
            <div class="mt-4 d-flex justify-content-end">
                {{ $orders->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
