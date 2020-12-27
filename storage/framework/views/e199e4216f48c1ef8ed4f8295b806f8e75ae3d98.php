<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.4, shrink-to-fit=no" />
        <meta name="description" content="">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(env('APP_NAME')); ?></title>

        <!-- Favicons -->
        

        <!-- Css Styles -->
        <link rel="stylesheet" type="text/css" href="/lib/fontawesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="/lib/line-awesome/css/line-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/lib/bootstrap-4.3.1.min.css">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- page-loader -->
    <div class="page-loader" id="page_loader">
        <div class="page-loader-bar"></div>
    </div>
    <!-- page-loader -->

    <script src="/lib/jquery-3.4.1.min.js"></script>
    <script src="/lib/popper-1.14.6.min.js"></script>
    <script src="/lib/bootstrap-4.3.1.min.js"></script>
    <script src="/lib/sortable-1.10.2.min.js"></script>
    <script src="/js/app.js"></script>
    </body>
</html>
<?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/layout.blade.php ENDPATH**/ ?>