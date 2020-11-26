@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Личный кабинет</h4>
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
                <div class="col-6 border-right">
                    <h5 class="mb-4 font-weight-normal">Основные данные</h5>
                    <form class="formValidate" method="POST" action="{{ route('customer.profile.update') }}" novalidate>
                        @csrf

                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label for="formName">Имя</label>
                            </div>
                            <div class="col">
                                <input id="formName" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->customer->name }}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label for="formPhone">Телефон</label>
                            </div>
                            <div class="col">
                                <input id="formPhone" type="tel" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->customer->phone }}" required>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label for="formAddress">Адрес</label>
                            </div>
                            <div class="col">
                                <input id="formAddress" type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $user->customer->address }}" required>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-sm btn-primary">Изменить</button>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <h5 class="mb-4 font-weight-normal">Параметры входа</h5>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>Эл. адрес</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" value={{ $user->email }} disabled>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary btn-sm shadow" data-toggle="modal" data-target="#emailEditModal">Изменить</button>
                            <div class="modal fade" id="emailEditModal" tabindex="-1" role="dialog" aria-labelledby="emailEditModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form class="formValidate" method="POST" action="{{ route('email.email') }}" novalidate>
                                            @csrf

                                            <div class="modal-header">
                                                <h5 class="modal-title">Изменить</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-sm-4">Эл. адрес</div>
                                                        <div class="col-sm-8">
                                                            <input name="email" type="email" class="form-control form-control-sm" value="{{ $user->email }}" autocomplete="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Отменить</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>Пароль</label>
                        </div>
                        <div class="col">
                            <input type="password" class="form-control form-control-sm" placeholder="******" disabled>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary btn-sm shadow" data-toggle="modal" data-target="#passwordEditModal">Изменить</button>
                            <div class="modal fade" id="passwordEditModal" tabindex="-1" role="dialog" aria-labelledby="passwordEditModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form class="formValidate" action="{{ route('customer.profile.password.update') }}" method="post" novalidate>
                                            @csrf

                                            <div class="modal-header">
                                                <h5 class="modal-title">Изменить</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="form-group form-row">
                                                        <div class="col-sm-4">
                                                            <label for="formPassword">Текущий пароль</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input id="formPassword" name="password" type="password" class="form-control form-control-sm" placeholder="******" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <div class="col-sm-4">
                                                            <label for="formNewPassword">Новый пароль</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input id="formNewPassword" name="new_password" type="password" class="form-control form-control-sm" placeholder="******" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <div class="col-sm-4">
                                                            <label for="formNewPasswordConfirmation">Подтверждение пароля</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input id="formNewPasswordConfirmation" name="new_password_confirmation" type="password" class="form-control form-control-sm" placeholder="******" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Отменить</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
