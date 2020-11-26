@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Ваш заказ #17 успешно создан!</h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5 col-lg-6">
                    <p>Мы свяжемся с Вами в рабочее время пн-сб с 10:00 до 17:00 для подтверждения заказа.</p>
                    <p>Спасибо за покупки в нашем интернет-магазине!</p>
                </div>
                <div class="col-7 col-lg-6 mb-4">
                    <div class="row border-bottom mx-0 py-2">
                        <div class="col"><a class="text-dark" href="http://doc.loc/shop/9">Аспиратор Би Велл Кидс WC-150</a></div>
                        <div class="col-auto">1 шт.</div>
                        <div class="col-auto">1460 с.</div>
                    </div>
                    <div class="row border-bottom mx-0 py-2">
                        <div class="col"><a class="text-dark" href="http://doc.loc/shop/9">Аспиратор Би Велл Кидс WC-150</a></div>
                        <div class="col-auto">1 шт.</div>
                        <div class="col-auto">1460 с.</div>
                    </div>
                    <div class="row mx-0 py-2 font-weight-bold">
                        <div class="col-auto ml-auto">Итог:</div>
                        <div class="col-auto">1460 с.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
