<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page"><?php echo app('translator')->get('Order ID'); ?>: #<?php echo e($order->id); ?></h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <?php if($order->isNewOrder): ?>
                <div class="alert alert-success" role="alert">
                    <h5 class="title-page">Ваш заказ успешно создан!</h5>
                    Мы свяжемся с Вами в рабочее время пн-сб с 8:00 до 18:00 для подтверждения заказа.<br>
                    Спасибо за покупки в нашем интернет-магазине!
                </div>
            <?php endif; ?>
            <article class="card mb-5">
                <header class="card-header">
                    <a href="#" class="float-right"><i class="fa fa-print"></i> <?php echo app('translator')->get('Print'); ?></a>
                    <span class="d-inline-block mr-3"><?php echo app('translator')->get('Order Date'); ?>: <?php echo e($order->date); ?></span>
                    <strong>Статус: <?php echo e($order->status->name); ?></strong>
                </header>
                <div class="card-body border-bottom">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="text-muted"><?php echo app('translator')->get('Delivery'); ?></h6>
                            <p>
                                Имя: <?php echo e($order->name); ?> <br>
                                Телефон: <?php echo e($order->phone); ?> <br>
                                Адрес: <?php echo e($order->address); ?> <br>
                                Комментарии к заказу: <?php echo e($order->comment); ?>

                            </p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted"><?php echo app('translator')->get('Payment'); ?></h6>
                            <span class="text-success">Наличными</span>
                            <p>
                                <?php echo app('translator')->get('Subtotal'); ?>: <?php echo e($order->total); ?> с. <br>
                                <?php echo e($order->delivery_type); ?>: <?php echo e($order->delivery_price); ?> с. <br>
                                <span class="b"><?php echo app('translator')->get('Total'); ?>: <?php echo e($order->general_total); ?> с. </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-hover">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                        <tr class="small text-uppercase">
                            <th scope="col">ТОВАР</th>
                            <th scope="col" width="100">Цена</th>
                            <th scope="col" width="145">Количество</th>
                            <th scope="col" width="100">Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img src="<?php echo e($product->image_medium); ?>" class="img-sm"></div>
                                        <figcaption class="info">
                                            <a href="<?php echo e(route('guest.product', $product->id)); ?>" class="title"><?php echo e($product->name); ?></a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td><?php echo e($product->price); ?> с.</td>
                                <td>
                                    <?php echo e($product->pivot->quantity); ?> шт.
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <span class="price"><?php echo e($product->price * $product->pivot->quantity); ?> с.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </article>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/customer/order/show.blade.php ENDPATH**/ ?>