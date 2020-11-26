@extends('layout')

@section('content')
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Подтвердите Ваш адрес электронной почты</h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            На ваш адрес электронной почты была отправлена новая ссылка для подтверждения.
                        </div>
                    @endif
                    <div>
                        В целях безопасности вам нужно подтвердить свой email адрес. Если вы не получили письмо,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf

                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">нажмите здесь</button>, чтобы получить ссылку для подтверждения еще раз.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
