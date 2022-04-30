@extends('admin.layout')

@section('content')
<div class="container my-4">
	<div class="row mb-5">
		<div class="col-lg-8 offset-lg-2">
            <h3 class="text-center mt-3">Заказ: #{{ $order->id }}</h3>
            <section>
                <h5 class="mt-4">Заказчик</h5>
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
                    <div class="col-6">Дата заказа:</div>
                    <div class="col-auto"><h6>{{ $order->created_at }}</h6></div>
                </div>
            </section>
            <div class="row mt-4 mb-2 align-items-center">
                <div class="col-auto">
                    <h5>Заказ</h5>
                </div>
                <div class="col-auto ml-auto">
                    <select class="form-control form-control-sm orderStatus {{ $order->status->color }}" data-id="{{ $order->id }}">
                        @foreach($statuses as $status)
                            <option {{ $status->id == $order->status->id ? 'selected' : null }} value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
			<div>
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
                <div class="row mt-3">
                    <div class="col"><h6>Сумма заказа:</h6></div>
                    <div class="col-auto">
                        <h6>{{ $order->total }} с.</h6>
                    </div>
                </div>
            </div>
            <h5 class="mt-4">Доставка</h5>
            <section>
                <div class="row py-2 border-bottom">
                    <div class="col">{{ $order->delivery_type }}</div>
                    <div class="col-auto"><h6>{{ $order->delivery_price }} с.</h6></div>
                </div>
                <div class="row py-2 border-bottom">
                    <div class="col">Дата доставки:</div>
                    <div class="col-auto"><h6>{{ $order->delivery_date }}</h6></div>
                </div>
            </section>
            <div class="text-right mt-5">
                <h5>Итого: {{ $order->generalTotal }} с.</h5>
            </div>
		</div>
	</div>
</div>
@endsection
