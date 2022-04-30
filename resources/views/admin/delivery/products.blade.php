@extends('admin.layout')

@section('content')
    <div class="container my-4">
        <h3 class="font-weight-normal">
            <a class="text-dark mr-3" href="{{ route('admin.delivery.index') }}">Заказы</a>
            <span>|</span>
            <a class="text-primary ml-3" href="{{ route('admin.delivery.products') }}">Продукты</a>
        </h3>
        <div class="pt-4">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Продукт</th>
                    <th scope="col">Количество</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr class="{{ $loop->index % 2 != 0 ? 'bg-light' : '' }}">
                        <th scope="row">{{ $product->id }}</th>
                        <td><a class="text-dark" style="text-decoration: underline" href={{ route('guest.product', $product->id) }}>{{ $product->name }}</a></td>
                        <td>{{ $product->order_quantity }}</td>
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
