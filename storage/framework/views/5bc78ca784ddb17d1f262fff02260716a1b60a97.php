<?php $__env->startSection('content'); ?>
    <div class="main-container">
        <section class="container-fluid my-5">
            <header class="section-heading">
                <h4 class="section-title">Популярные товары</h4>
            </header>
            <div class="row">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-4 col-lg-3">
                        <?php echo $__env->make('product.middle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/guest/index.blade.php ENDPATH**/ ?>