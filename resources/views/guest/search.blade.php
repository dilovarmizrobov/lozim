@extends('layout')

@section('content')
    <section class="bg-light py-2 mt-3">
        <div class="main-container">
            <div class="container-fluid">
                <nav>
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a class="text-dark" href="{{ route('guest.index') }}">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $searchText }}</li>
                    </ol>
                </nav>
                <h4 class="title-page">Результаты поиска по запросу " {{ $searchText }} " ( {{ $products->total() }} )</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5 mt-2">
        <div class="container-fluid">
            <header class="border-bottom mb-4 pb-3">
                <div class="row no-gutters">
                    <div class="col-auto mr-2">
                        @if($sort === 'newly')
                            <span class="text-success">Новые</span>
                        @else
                            <a href="{{ route('guest.search', ['search' => $searchText, 'sort' => 'newly']) }}" class="text-dark">Новые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'priceup')
                            <span class="text-success">Дешевые</span>
                        @else
                            <a href="{{ route('guest.search', ['search' => $searchText, 'sort' => 'priceup']) }}" class="text-dark">Дешевые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'pricedown')
                            <span class="text-success">Дорогие</span>
                        @else
                            <a href="{{ route('guest.search', ['search' => $searchText, 'sort' => 'pricedown']) }}" class="text-dark">Дорогие</a>
                        @endif
                    </div>
                </div>
            </header>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-4 col-lg-3">
                        @include('product.middle')
                    </div>
                @empty
                    <div class="col my-5 py-5 text-center">
                        По вашему запросу ничего не найдено!
                    </div>
                @endforelse
            </div>
            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
