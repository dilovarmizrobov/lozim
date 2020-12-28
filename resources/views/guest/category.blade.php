@extends('layout')

@section('content')
    <section class="bg-light py-2 mt-3">
        <div class="main-container">
            <div class="container-fluid">
                <nav>
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a class="text-dark" href="{{ route('guest.index') }}">Главная</a></li>
                        @foreach($array_breadcrumb as $breadcrumb)
                            @if($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                            @else
                                <li class="breadcrumb-item"><a class="text-dark" href="{{ route('guest.category', $breadcrumb['href']) }}">{{ $breadcrumb['title'] }}</a></li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
                <h4 class="title-page">{{ $category->name }}</h4>
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
                            <a href="{{ route('guest.category', ['slug'=> request()->slug, 'sort' => 'newly']) }}" class="text-dark">Новые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'priceup')
                            <span class="text-success">Дешевые</span>
                        @else
                            <a href="{{ route('guest.category', ['slug'=> request()->slug, 'sort' => 'priceup']) }}" class="text-dark">Дешевые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'pricedown')
                            <span class="text-success">Дорогие</span>
                        @else
                            <a href="{{ route('guest.category', ['slug'=> request()->slug, 'sort' => 'pricedown']) }}" class="text-dark">Дорогие</a>
                        @endif
                    </div>
                </div>
            </header>
            <div class="row">
                <div class="col-4 col-lg-3">
                    <div class="filter-widget">
                        <div class="filter-catagories">
                            @foreach($category->neighbors() as $neighbor)
                                @if($category->id == $neighbor->id)
                                    <div class="fwc-title active">
                                        <span>{{ $category->name }}</span>
                                        <ul class="filter-catagories ml-2">
                                            @foreach($category->children as $child)
                                                <li>
                                                    <a href="{{ route('guest.category', $child->get_full_slug()) }}">{{ $child->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @continue
                                @endif
                                <a class="fwc-title" href="{{ route('guest.category', $neighbor->get_full_slug()) }}">{{ $neighbor->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-6 col-lg-4">
                                @include('product.middle')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
