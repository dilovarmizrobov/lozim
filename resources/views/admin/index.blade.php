@extends('admin.layout')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-6 col-md-4 mb-4">
            <a href="{{ route('admin.product.index') }}">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-dark my-4">Продукты</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4 mb-4">
            <a href="{{ route('admin.categories.index') }}">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-dark my-4">Каталог</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4 mb-4">
            <a href="{{ route('admin.order.index') }}">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-dark my-4">Заказы</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4 mb-4">
            <a href="{{ route('admin.delivery.index') }}">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-dark my-4">Доставки</h5>
                    </div>
                </div>
            </a>
        </div>
{{--        <div class="col-6 col-md-4 mb-4">--}}
{{--            <a href="{{ route('admin.properties.index') }}">--}}
{{--                <div class="card text-center">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title text-dark my-4">Атрибуты</h5>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
        <div class="col-6 col-md-4 mb-4">
            <a href="{{ route('admin.feedback.index') }}">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-dark my-4">Отзывы</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
