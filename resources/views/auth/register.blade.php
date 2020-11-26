@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Регистрация</h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <h4 class="mb-4">Новый пользователь</h4>
            <form class="formValidate" method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <div class="row">
                    <div class="col-6">
                        <div class="form-group w-75">
                            <label for="formName">* Имя</label>
                            <input id="formName" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group w-75">
                            <label for="formEmail">* Электронный адрес</label>
                            <input id="formEmail" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group w-75">
                            <label for="formPhone">* Телефонный номер</label>
                            <input id="formPhone" type="tel" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group w-75">
                            <label for="formPassword">* Пароль</label>
                            <input id="formPassword" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required>
                            <span class="small font-weight-light">Не менее 8 символов, обязательно должен содержать: цифры, заглавные и строчные буквы</span>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group w-75">
                            <label for="formPasswordConfirmation">* Повторите пароль</label>
                            <input id="formPasswordConfirmation" type="password" class="form-control form-control-sm" name="password_confirmation" required>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Регистрация</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
