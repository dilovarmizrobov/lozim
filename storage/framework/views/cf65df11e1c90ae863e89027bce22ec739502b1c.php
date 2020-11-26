<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Ваш заказ #<?php echo e($order->id); ?> успешно создан!</h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-7 col-lg-6 mb-4">
                    <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row border-bottom mx-0 py-2">
                            <div class="col"><a class="text-dark" href="http://doc.loc/shop/9"><?php echo e($product->name); ?></a></div>
                            <div class="col-auto"><?php echo e($product->pivot->quantity); ?> шт.</div>
                            <div class="col-auto"><?php echo e($product->price); ?> с.</div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="row mx-0 py-2 font-weight-bold">
                        <div class="col-auto ml-auto">Итог:</div>
                        <div class="col-auto"><?php echo e($order->total); ?> с.</div>
                    </div>
                </div>
                <div class="col-5 col-lg-6">
                    <p>Мы свяжемся с Вами в рабочее время пн-сб с 8:00 до 18:00 для подтверждения заказа.</p>
                    <p>Спасибо за покупки в нашем интернет-магазине!</p>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/customer/order/show.blade.php ENDPATH**/ ?>