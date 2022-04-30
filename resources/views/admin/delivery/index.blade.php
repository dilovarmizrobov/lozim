@extends('admin.layout')

@section('content')
    <div class="container my-4">
        <h3 class="font-weight-normal">
            <a class="text-primary mr-3" href="{{ route('admin.delivery.index') }}">Заказы</a>
            <span>|</span>
            <a class="text-dark ml-3" href="{{ route('admin.delivery.products') }}">Продукты</a>
        </h3>
        <div class="pt-4">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Дата доставки</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Сумма</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr class="{{ $loop->index % 2 != 0 ? 'bg-light' : '' }}">
                        <th scope="row">{{ $order->id }}</th>
                        <td>
                            <a class="text-dark" style="text-decoration: underline" href={{ route('admin.order.show', $order->id) }}>{{ $order->delivery_date }}</a>
                        </td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->generalTotal }} с.</td>
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
@endsection
