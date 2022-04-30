@extends('layout')

@section('content')
    <section class="p-3 my-3">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Избранные товары</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-4 col-lg-3">
                        @include('product.middle')
                    </div>
                @empty
                    <div class="col my-5 py-5 text-center">
                        <h6 class="mb-3 font-weight-normal">Ничего не найдено</h6>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
