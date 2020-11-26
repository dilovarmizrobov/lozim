<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5, shrink-to-fit=no" />
    <meta name="description" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin Tojir</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/lib/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/lib/bootstrap-4.3.1.min.css">
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
</head>
<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <header>
        <nav class="navbar navbar-expand-sm navbar-light border-bottom">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(route('admin.index')); ?>">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">

                        <?php if(auth()->guard()->guest()): ?>

                        <li><a class="nav-link" href="<?php echo e(route('login')); ?>">Войти</a></li>
                        <li><a class="nav-link" href="<?php echo e(route('register')); ?>">Регистрация</a></li>

                        <?php else: ?>

                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                <?php echo e(Auth::user()->email); ?>

                            </a>

                            <ul class="dropdown-menu">
                                <a class="dropdown-item" href=<?php echo e(route('admin.product.index')); ?>>Продукты</a>
                                <a class="dropdown-item" href=<?php echo e(route('admin.order.index')); ?>>Заказы</a>
                                <a class="dropdown-item" href=<?php echo e(route('admin.categories.index')); ?>>Каталог</a>
                                <a class="dropdown-item" href=<?php echo e(route('admin.feedback.index')); ?>>Отзывы</a>
                                <hr class="m-2">
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Выйти</a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </ul>
                        </li>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Scripts -->
    <script src="/lib/jquery-3.4.1.min.js"></script>
    <script src="/lib/popper-1.14.6.min.js"></script>
    <script src="/lib/bootstrap-4.3.1.min.js"></script>
    <script src="/lib/sortable-1.10.2.min.js"></script>
    <script src="/js/admin.js"></script>
</body>
</html>
<?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/layout.blade.php ENDPATH**/ ?>