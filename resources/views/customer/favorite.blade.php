@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Избранные товары</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-4 col-lg-3">
                        @include('product.middle')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
