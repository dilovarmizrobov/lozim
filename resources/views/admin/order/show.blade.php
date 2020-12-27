@extends('admin.layout')

@section('content')
<div class="container py-4">
	<div class="row mb-5">
		<div class="col-lg-8 offset-lg-2">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <h3 class="mb-3">Заказ: #{{ $order->id }}</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-outline-primary">Назад</a>
                </div>
            </div>
			<h4 class="mt-3">Заказчик</h4>
			<div class="ml-3">
                <div class="row border-bottom py-2">
                    <div class="col-6">Имя</div>
                    <div class="col-auto">{{ $order->name }}</div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-6">Телефон</div>
                    <div class="col-auto">{{ $order->phone }}</div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-6">Адрес</div>
                    <div class="col-auto">{{ $order->address }}</div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-6">Комментарии к заказу</div>
                    <div class="col-auto">{{ $order->comment }}</div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-6">Время и дата:</div>
                    <div class="col-auto"><h6>{{ $order->data }}</h6></div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-auto">
                    <h4>Заказ</h4>
                </div>
                <div class="col-auto">
                    <select class="form-control form-control-sm orderStatus {{ $order->status->id == 1 ? 'bg-light' : ($order->status->id == 2 ? 'bg-success text-white' : 'bg-danger text-white') }}" data-id="{{ $order->id }}">
                        @foreach($statuses as $status)
                            <option {{ $status->id == $order->status->id ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
			<div class="ml-3">
                @foreach($order->products as $product)
                    <div class="row border-bottom py-2">
                        <div class="col"><a class="text-dark" href={{ route('guest.product', $product->id) }}>{{ $product->name }}</a></div>
                        <div class="col-auto">
                            <span>{{ $product->pivot->quantity }}</span>
                            <i class="las la-times" style="font-size: 12px"></i>
                            <span>{{ $product->pivot->price }} с.</span>
                            <i class="las la-long-arrow-alt-right" style="font-size: 12px"></i>
                            <span>{{ $product->pivot->price * $product->pivot->quantity }} с.</span>
                        </div>
                    </div>
                @endforeach
                <div class="row py-2">
                    <div class="col"><h6>Сумма заказов:</h6></div>
                    <div class="col-auto"><h6>{{ $order->total }} с.</h6></div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-auto">
                    <h4>Доставка</h4>
                </div>
            </div>
            <div class="ml-3">
                <div class="row py-2 border-bottom">
                    <div class="col">{{ $order->delivery_type }}</div>
                    <div class="col-auto"><h6>{{ $order->delivery_price }} с.</h6></div>
                </div>
                <div class="text-center mt-5">
                    <h4>Итого: {{ $order->generalTotal }} с.</h4>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
