@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Восстановление пароля</h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h6 class="mb-4">Что делать, если Вы забыли свой пароль?</h6>
                    <p>В форму ниже введите свой электронный адрес, указанный при регистрации. Через несколько минут на Ваш E-mail придёт письмо с дальнейшими инструкциями.</p>
                    <form class="formValidate" method="POST" action="{{ route('password.email') }}" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="formEmail">Электронный адрес</label>
                            <input id="formEmail" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Отправить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
