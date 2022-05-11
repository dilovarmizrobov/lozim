<nav class="navbar navbar-main navbar-expand navbar-light border-bottom fixed-top bg-white">
    <div class="main-container">
        <div class="container-fluid">
            <div class="row no-gutters">
                <a class="navbar-brand" href="{{ route('guest.index') }}">{{ env('APP_NAME') }}</a>
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre="">
                                @lang('Account Setting')
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('login') }}">@lang('User Login')</a>
                                <a class="dropdown-item" href="{{ route('register') }}">@lang('User register')</a>
                            </div>
                        </li>
                    @endguest
                    @auth
                        @if (Auth::user()->can('is_admin'))
                            <li class="nav-item">
                                <a class="nav-link">Hello Admin!</a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre="">
                                    {{ Auth::user()->email }}
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('customer.profile.index') }}">@lang('Account Setting')</a>
                                    <a class="dropdown-item" href="{{ route('customer.order.index') }}">@lang('My Orders')</a>
                                    <a class="dropdown-item" href="{{ route('customer.favorite.index') }}">Избранные товары</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="http://mdk.loc/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            <span class="header_count_products">{{ Cart::content()->count() }}</span> шт. - <span class="header_total_price">{{ Cart::subtotal() }}</span> c.
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="main-container mt-4">
    <section class="container-fluid">
        <div class="catalog-menu js-catalogMenu">
            <div class="row">
                <div class="col-4 col-lg-3">
                    <div class="catalog-menu__title js-toggleCatalogMenu">
                        <span>Каталог товаров</span>
                        <i class="las la-bars show"></i>
                        <i class="las la-times hide"></i>
                    </div>
                </div>
                <div class="col">
                    <form action="{{ route('guest.search') }}" method="GET" class="search">
                        <div class="input-group w-100">
                            <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="Введите слово для поиска">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    Найти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="catalogMenu-content">
                <div class="row mt-4">
                    <div class="col-4 col-lg-3">
                        <div class="catalog-menu__list-content">
                            <div class="catalog-menu__list-content-box">
                                @foreach($categories as $category)
                                    <div class="catalog-menu__list-item">
                                        <a href="{{ route('guest.category', $category->get_full_slug()) }}">
                                            <span>{{ $category->name }}</span>
                                            @if(!$category->children->isEmpty())
                                                <i class="las la-angle-right"></i>
                                            @endif
                                        </a>
                                        @if(!$category->children->isEmpty())
                                            <div class="catalog-menu__submenu border">
                                                @foreach($category->children as $child)
                                                    <div class="catalog-menu__submenu__list-item">
                                                        <a href="{{ route('guest.category', $child->get_full_slug()) }}">
                                                            <span>{{ $child->name }}</span>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div id="carouselMainCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselMainCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselMainCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselMainCaptions" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/img/banner1.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="/img/banner2.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="/img/banner3.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselMainCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselMainCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
