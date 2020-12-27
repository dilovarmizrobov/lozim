<h3>Заказ: #{{ $order->id }}</h3>
<div style="margin-bottom: 5px;"><b>Заказчик</b></div>
Контактное лицо: <b>{{ $order->name }}</b>
<br>
Номер телефона: <b>{{ $order->phone }}</b>
<br>
{{ $order->delivery_type }}: <b>{{ $order->delivery_price }} с.</b>
<br>
Адрес доставки: <b>{{ $order->address }}</b>
<br>
Комментарии к заказу: <b>{{ $order->comment }}</b>
<br>
<div style="margin: 15px  0 5px;"><b>Заказ</b></div>
@foreach($order->products as $product)
    <div>
        {{ $product->name }} / {{ $product->pivot->quantity }} шт. / {{ $product->pivot->price }} руб. / {{ $product->pivot->quantity * $product->pivot->price }} руб.
    </div>
@endforeach
<h3>Итог: {{ $order->general_total }} руб.</h3>
