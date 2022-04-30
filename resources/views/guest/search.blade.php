@extends('layout')

@section('content')
    <section class="mt-3">
        <div class="main-container">
            <div class="container-fluid">
                <nav>
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a class="text-dark" href="{{ route('guest.index') }}">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $searchText }}</li>
                    </ol>
                </nav>
                <header class="section-heading">
                    <h4 class="section-title">Результаты поиска по запросу " {{ $searchText }} " ( {{ $products->total() }} )</h4>
                </header>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <header class="mb-3">
                <div class="row no-gutters">
                    <div class="col-auto mr-2">
                        @if($sort === 'newly')
                            <a href="{{ route('guest.search', ['search' => $searchText]) }}" class="text-primary">Новые</a>
                        @else
                            <a href="{{ route('guest.search', ['search' => $searchText, 'sort' => 'newly']) }}" class="title-link">Новые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'priceup')
                            <a href="{{ route('guest.search', ['search' => $searchText]) }}" class="text-primary">Дешевые</a>
                        @else
                            <a href="{{ route('guest.search', ['search' => $searchText, 'sort' => 'priceup']) }}" class="title-link">Дешевые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'pricedown')
                            <a href="{{ route('guest.search', ['search' => $searchText]) }}" class="text-primary">Дорогие</a>
                        @else
                            <a href="{{ route('guest.search', ['search' => $searchText, 'sort' => 'pricedown']) }}" class="title-link">Дорогие</a>
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
