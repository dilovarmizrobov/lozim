@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Обратная связь</h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5 mt-2">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form class="formValidate" method="post" action="{{ route('guest.feedback.store') }}" novalidate>
                @csrf

                <div class="row">
                    <div class="col-md-8 col-lg-7 mt-2">
                        <p>ТИП ОБРАЩЕНИЯ</p>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <select name="appeal" class="custom-select">
                                        <option value="Благодарность" selected>Благодарность</option>
                                        <option value="Замечание">Замечание</option>
                                        <option value="Предложение">Предложение</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="categoryAppeal" class="custom-select">
                                        <option value="Продукт">Продукт</option>
                                        <option value="Сервис">Сервис</option>
                                        <option value="Оплата">Оплата</option>
                                        <option value="Прочее">Прочее</option>
                                    </select>
                                </div>
                                <div class="col-6 mt-3">
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? (Auth::check() ? Auth::user()->customer->name : '') }}" placeholder="Ваше имя" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6 mt-3">
                                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ?? (Auth::check() ? Auth::user()->customer->phone : '') }}" placeholder="Телефон для связи">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6 mt-3">
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? (Auth::check() ? Auth::user()->email : '') }}" placeholder="Электронный адрес" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <p class="mt-5">ОБРАЩЕНИЕ</p>
                        <div class="form-group">
                            <textarea name="review" class="form-control @error('review') is-invalid @enderror" rows="4" placeholder="Ваш отзыв" required>{{ old('review') }}</textarea>

                            @error('review')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group custom-control custom-checkbox">
                            <input id="formContactAgree" type="checkbox" class="custom-control-input @error('contactAgree') is-invalid @enderror" name="contactAgree" {{ old('contactAgree') === 'on' ? 'checked' : '' }} required>
                            <label for="formContactAgree" class="custom-control-label text-muted small">Я ознакомлен с содержанием пользовательского соглашения и принимаю условия обработки персональных данных.</label>

                            @error('contactAgree')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Отправить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
