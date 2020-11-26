@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Вход в личный кабинет</h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 border-right">
                    <h4 class="mb-4">Авторизация</h4>
                    <form class="formValidate" method="POST" action="{{ route('login') }}" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="formEmail">Электронный адрес</label>
                            <input id="formEmail" type="email" class="form-control w-75 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="formPassword">Пароль</label>
                            <input id="formPassword" type="password" class="form-control w-75 @error('password') is-invalid @enderror" name="password" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Запомнить меня</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Войти</button>
                            <a class="btn btn-link" href="{{ route('password.request') }}">Забыли пароль?</a>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <h4 class="card-title mb-4">Регистрация</h4>
                    <h5></h5>
                    <p><span class="font-weight-bold">Рекомендуем Вам зарегистрироваться</span> в нашем интернет-магазине, чтобы не вводить каждый раз адресные данные при оформлении заказа. А также:</p>
                    <ul>
                        <li>В Вашем личном кабинете будет сохраняться история Ваших заказов</li>
                        <li>Вы сможете составлять список избранных товаров</li>
                    </ul>
                    <p>Личные сведения, полученные в распоряжении интернет-магазина www.brand.ru при регистрации или каким-либо иным образом, будут использованы исключительно для исполнения Ваших заказов, и не будут передаваться третьим организациям и лицам, без Вашего согласия, за исключением ситуаций, когда этого требует закон или судебное решение.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </section>
@endsection
