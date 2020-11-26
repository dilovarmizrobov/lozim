<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Мои заказы</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <header class="border-bottom mb-4 pb-3">
                <div class="row no-gutters">
                    <?php $__currentLoopData = $sorting_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-auto mr-2">
                            <a href="<?php echo e(route('customer.order.index', ['sort' => $item->slug])); ?>" class="text-dark"><?php echo e($item->sort_name); ?></a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </header>
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="card mb-5">
                    <header class="card-header">
                        <a href="#" class="float-right"><i class="fa fa-print"></i> <?php echo app('translator')->get('Print'); ?></a>
                        <strong class="d-inline-block text-dark mr-3"><?php echo app('translator')->get('Order ID'); ?>: <?php echo e($order->id); ?></strong>
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

                                    <span class="b"><?php echo app('translator')->get('Total'); ?>: <?php echo e($order->total); ?> с. </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-hover">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Наименование</th>
                                <th scope="col" width="100">Цена</th>
                                <th scope="col" width="145">Количество</th>
                                <th scope="col" width="100">Сумма</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $order->products()->limit(2)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <figure class="itemside">
                                            <div class="aside"><img src="<?php echo e($product->image_medium); ?>" class="img-sm"></div>
                                            <figcaption class="info">
                                                <a href="#" class="title"><?php echo e($product->name); ?></a>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>
                                        <div class="price-wrap">
                                            <span class="price"><?php echo e($product->price); ?> с.</span>
                                        </div>
                                    </td>
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
                    <div class="text-center mb-4">
                        <a href="<?php echo e(route('customer.order.show', $order->id)); ?>" class="btn btn-outline-primary">Открыть заказ</a>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="my-5 py-5 text-center">
                    <h3 class="mb-3">Ничего не найдено.</h3>
                    <a href="<?php echo e(route('guest.index')); ?>" class="btn btn-primary">Продолжить покупки</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/customer/order/index.blade.php ENDPATH**/ ?>