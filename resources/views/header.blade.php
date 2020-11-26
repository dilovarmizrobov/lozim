<nav class="navbar navbar-main navbar-expand navbar-light border-bottom fixed-top bg-white">
    <div class="main-container">
        <div class="container-fluid">
            <div class="row no-gutters">
                <a class="navbar-brand" href="{{ route('guest.index') }}">Brand</a>
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
                    @can('is_customer')
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre="">
                                {{ Auth::user()->email }}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('customer.index') }}">@lang('Customer') #{{ auth()->user()->id }}</a>
                                <a class="dropdown-item" href="{{ route('customer.order.index') }}">@lang('My Orders')</a>
                                <a class="dropdown-item" href="{{ route('customer.favorite.index') }}">Избранные товары</a>
                                <a class="dropdown-item" href="{{ route('customer.profile.index') }}">@lang('Account Setting')</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="http://mdk.loc/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Выход
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endcan
                    @can('is_admin')
                        <li class="nav-item">
                            <a class="nav-link">Hello Admin!</a>
                        </li>
                    @endcan
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
<div class="main-container mt-5 pt-5">
    <section class="container-fluid">
        <div class="row catalog-menu js-catalogMenu">
            <div class="col-4 col-lg-3">
                <div class="catalog-menu__title js-toggleCatalogMenu">
                    <span>Каталог товаров</span>
                    <i class="las la-bars show"></i>
                    <i class="las la-times hide"></i>
                </div>
                <div class="catalog-menu__list-content">
                    <div class="catalog-menu__list-item">
                        <a href="#">% Скидки</a>
                    </div>
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
                <div id="carouselMainCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselMainCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselMainCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselMainCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/banners/2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>First slide label</h5>
                                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/banners/2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/banners/2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Third slide label</h5>
                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                            </div>
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
    </section>
</div>
