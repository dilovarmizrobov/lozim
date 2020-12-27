<nav class="navbar navbar-main navbar-expand navbar-light border-bottom fixed-top bg-white">
    <div class="main-container">
        <div class="container-fluid">
            <div class="row no-gutters">
                <a class="navbar-brand" href="<?php echo e(route('guest.index')); ?>"><?php echo e(env('APP_NAME')); ?></a>
                <ul class="navbar-nav ml-auto">
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre="">
                                <?php echo app('translator')->get('Account Setting'); ?>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo e(route('login')); ?>"><?php echo app('translator')->get('User Login'); ?></a>
                                <a class="dropdown-item" href="<?php echo e(route('register')); ?>"><?php echo app('translator')->get('User register'); ?></a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->can('is_admin')): ?>
                            <li class="nav-item">
                                <a class="nav-link">Hello Admin!</a>
                            </li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre="">
                                    <?php echo e(Auth::user()->email); ?>

                                </a>
                                <div class="dropdown-menu">

                                    <a class="dropdown-item" href="<?php echo e(route('customer.profile.index')); ?>"><?php echo app('translator')->get('Account Setting'); ?></a>
                                    <a class="dropdown-item" href="<?php echo e(route('customer.order.index')); ?>"><?php echo app('translator')->get('My Orders'); ?></a>
                                    <a class="dropdown-item" href="<?php echo e(route('customer.favorite.index')); ?>">Избранные товары</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="http://mdk.loc/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" hidden>
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('cart.index')); ?>">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            <span class="header_count_products"><?php echo e(Cart::content()->count()); ?></span> шт. - <span class="header_total_price"><?php echo e(Cart::subtotal()); ?></span> c.
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



                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="catalog-menu__list-item">
                            <a href="<?php echo e(route('guest.category', $category->get_full_slug())); ?>">
                                <span><?php echo e($category->name); ?></span>
                                <?php if(!$category->children->isEmpty()): ?>
                                    <i class="las la-angle-right"></i>
                                <?php endif; ?>
                            </a>
                            <?php if(!$category->children->isEmpty()): ?>
                                <div class="catalog-menu__submenu border">
                                    <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="catalog-menu__submenu__list-item">
                                            <a href="<?php echo e(route('guest.category', $child->get_full_slug())); ?>">
                                                <span><?php echo e($child->name); ?></span>
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col">
                <form action="<?php echo e(route('guest.search')); ?>" method="GET" class="search">
                    <div class="input-group w-100">
                        <input type="text" class="form-control" name="search" value="<?php echo e(request()->search); ?>" placeholder="Введите слово для поиска">
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
<?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/header.blade.php ENDPATH**/ ?>