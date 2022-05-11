@extends('layout')

@section('title', $category->name)

@section('content')
    <section class="mt-3">
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
                <header class="section-heading">
                    <h4 class="section-title">{{ $category->name }}</h4>
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
                            <a href="{{ route('guest.category', ['slug'=> request()->slug]) }}" class="text-primary">Новые</a>
                        @else
                            <a href="{{ route('guest.category', ['slug'=> request()->slug, 'sort' => 'newly']) }}" class="title-link">Новые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'priceup')
                            <a href="{{ route('guest.category', ['slug'=> request()->slug]) }}" class="text-primary">Дешевые</a>
                        @else
                            <a href="{{ route('guest.category', ['slug'=> request()->slug, 'sort' => 'priceup']) }}" class="title-link">Дешевые</a>
                        @endif
                    </div>
                    <div class="col-auto mr-2">
                        @if($sort === 'pricedown')
                            <a href="{{ route('guest.category', ['slug'=> request()->slug]) }}" class="text-primary">Дорогие</a>
                        @else
                            <a href="{{ route('guest.category', ['slug'=> request()->slug, 'sort' => 'pricedown']) }}" class="title-link">Дорогие</a>
                        @endif
                    </div>
                </div>
            </header>
            <div class="row">
                <div class="col-4 col-lg-3">
                    <div class="filter-widget">
                        @if($category->parent)
                            <div class="filter-catagories">
                                <a class="fwc-title" href="{{ route('guest.category', $category->parent->get_full_slug()) }}">{{ $category->parent->name }}</a>
                                <hr>
                            </div>
                        @endif
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
                        @forelse($products as $product)
                            <div class="col-6 col-lg-4">
                                @include('product.middle')
                            </div>
                        @empty
                            <div class="col">
                                <p class="text-center py-5 my-5">
                                    Ничего не найдено
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
