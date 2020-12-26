@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Оформление заказа</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-7 mb-4">
                    <section>
                        <h5 class="mb-3">Ваш заказ</h5>
                        @foreach (Cart::content() as $product)
                            <div class="row border-bottom mx-0 py-2">
                                <div class="col"><a class="text-dark" href="{{ route('guest.product', $product->id) }}">{{ $product->name }}</a></div>
                                <div class="col-auto">{{ $product->qty }} <i class="las la-times" style="font-size: 12px"></i> {{ $product->price }} с.</div>
                                <div class="col-auto">{{ $product->price * $product->qty }} с.</div>
                            </div>
                        @endforeach
                        <div class="row mx-0 py-2">
                            <div class="col-auto ml-auto">Сумма заказов:</div>
                            <div class="col-auto font-weight-bold">{{ Cart::subtotal() }} с.</div>
                        </div>
                    </section>
                    <section>
                        <h5 class="mb-3">Тип доставки</h5>
                        <div class="row mx-0 py-2">
                            <div class="col">
                                <div class="custom-control custom-switch">
                                    <input type="radio" name="checkoutDelivery" value="regular" class="custom-control-input" id="regularDelivery" data-price="{{ $delivery_price }}" checked>
                                    <label class="custom-control-label" for="regularDelivery">Обычная доставка</label>
                                    <a data-toggle="collapse" href="#regularDeliveryCollapse" aria-expanded="false" aria-controls="regularDeliveryCollapse"><i class="fas fa-info-circle"></i></a>
                                    <div class="collapse" id="regularDeliveryCollapse">
                                        <p class="mt-2 small">
                                            При сумме заказа свыше {{ $delivery_from }} сомони – ДОСТАВКА БЕСПЛАТНАЯ!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto regularDeliveryPrice"><span class="font-weight-bold">{{ $hasFreeShipping ? 'бесплатно.' : "$delivery_price с." }}</span></div>
                        </div>
                        <div class="row mx-0 py-2">
                            <div class="col">
                                <div class="custom-control custom-switch">
                                    <input type="radio" name="checkoutDelivery" value="express" class="custom-control-input" id="expressDelivery" data-price="{{ $delivery_express_price }}">
                                    <label class="custom-control-label" for="expressDelivery">Срочная доставка</label>
                                    <a data-toggle="collapse" href="#expressDeliveryCollapse" aria-expanded="false" aria-controls="expressDeliveryCollapse"><i class="fas fa-info-circle"></i></a>
                                    <div class="collapse" id="expressDeliveryCollapse">
                                        <p class="mt-2 small">
                                            Время доставки 2-3 ч.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto expressDeliveryPrice d-none"><span class="font-weight-bold">{{ $delivery_express_price }} с.</span></div>
                        </div>
                        <div class="row border-top mt-2 mx-0 py-2 font-weight-bold">
                            <div class="col-auto ml-auto">ИТОГО:</div>
                            <div class="col-auto"><span class="checkoutTotal">{{ $total }}</span> с.</div>
                            <input type="hidden" name="checkoutTotal" value="{{ Cart::subtotal() }}">
                        </div>
                    </section>
                </div>
                <div class="col-5">
                    <h5 class="mb-3">Ваши данные</h5>
                    <form class="formValidate" method="POST" action="{{ route('customer.checkout.store') }}" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="formName">Имя *</label>
                            <input id="formName" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->customer->name }}" required>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="formPhone">Телефон *</label>
                            <input id="formPhone" type="tel" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? Auth::user()->customer->phone }}" required>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="formAddress">Адрес *</label>
                            <input id="formAddress" type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? Auth::user()->customer->address }}" required>

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="formComment">Комментарии к заказу</label>
                            <textarea id="formComment" class="form-control form-control-sm" name="comment"></textarea>
                        </div>
                        <div class="form-group custom-control custom-checkbox">
                            <input id="formContactAgree" type="checkbox" class="custom-control-input @error('contactAgree') is-invalid @enderror" name="contactAgree" required>
                            <label for="formContactAgree" class="custom-control-label">Я ознакомлен с содержанием пользовательского соглашения.</label>

                            @error('contactAgree')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="delivery" value="regular">
                        <button type="submit" class="btn btn-primary">Оформить заказ</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
