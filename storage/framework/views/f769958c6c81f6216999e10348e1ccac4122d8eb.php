<?php $__env->startSection('content'); ?>
<div class="container my-4">
    <div class="row">
        <div class="col-6 col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Каталог</h5>
                    <p class="card-text">Количество: <?php echo e($categories->count()); ?></p>
                    <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-primary">Посмотреть</a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Атрибуты</h5>
                    <p class="card-text">Количество: <?php echo e($attributes->count()); ?></p>
                    <a href="<?php echo e(route('admin.properties.index')); ?>" class="btn btn-primary">Посмотреть</a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Отзывы</h5>
                    <p class="card-text">Количество: <?php echo e($feedbacks->count()); ?></p>
                    <a href="<?php echo e(route('admin.feedback.index')); ?>" class="btn btn-primary">Посмотреть</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/home.blade.php ENDPATH**/ ?>