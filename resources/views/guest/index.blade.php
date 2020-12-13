@extends('layout')

@section('content')
    <div class="main-container">
        <section class="container-fluid my-5">
            <header class="section-heading">
                <a href="#" class="btn btn-outline-primary float-right">See all</a>
                <h4 class="section-title">Popular products</h4>
            </header>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-4 col-lg-3">
                        @include('product.middle')
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
