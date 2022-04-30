@extends('admin.layout')

@section('content')
	<div class="container my-4">
		<div class="row">
			<div class="col-sm-3">
                <h3 class="font-weight-normal">
                    <a class="text-dark" href="{{ route('admin.order.index') }}">Заказы</a>
                </h3>
            </div>
            <div class="col-sm-auto ml-auto mt-4 mt-sm-0">
                <form action="{{ route('admin.order.index') }}" method="get">
                    <div class="row no-gutters">
                        <div class="col mr-3">
                            <input class="form-control form-control-sm" name="search" type="text" value="{{ request()->search }}" placeholder="ID заказа">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
        <section class="mt-3">
            @if(request()->has('search') && !is_null(request()->search))
                <div class="mb-4">
                    <h5 class="font-weight-normal">Результаты поиска: " {{ request()->search }} "</h5>
                </div>
            @endif
            <div class="row no-gutters">
                @foreach($statuses as $item)
                    <div class="col-auto mr-3">
                        @if(request()->sort === $item->slug)
                            <a href="{{ route('admin.order.index') }}" class="text-primary">{{ $item->name }}</a>
                        @else
                            <a href="{{ route('admin.order.index', ['sort' => $item->slug]) }}" class="text-dark">{{ $item->name }}</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
        <div class="mt-3">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Дата доставки</th>
                        <th scope="col">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr {{ $loop->index % 2 != 0 ? 'class="bg-light"' : null }}>
                            <th scope="row">{{ $order->id }}</th>
                            <td><a class="text-dark" style="text-decoration: underline" href={{ route('admin.order.show', $order->id) }}>{{ $order->name }}</a></td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->generalTotal }} с.</td>
                            <td>{{ $order->delivery_date }}</td>
                            <td>
                                <select class="form-control form-control-sm orderStatus {{ $order->status->color }}" data-id="{{ $order->id }}">
                                    @foreach($statuses as $status)
                                        <option {{ $status->id == $order->status->id ? 'selected' : null }} value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </td>
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
	</div>
@endsection
