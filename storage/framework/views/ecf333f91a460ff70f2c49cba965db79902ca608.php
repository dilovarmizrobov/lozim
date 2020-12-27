<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Мои заказы</h4>
            </div>
        </div>
    </section>
    <section class="main-container">
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
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-lg-6">
                        <article class="card mb-5 shadow">
                            <header class="card-header d-flex justify-content-between">
                                <strong><?php echo app('translator')->get('Order Date'); ?>: <?php echo e($order->date); ?></strong>
                                <span>Статус: <?php echo e($order->status->name); ?></span>
                            </header>
                            <div class="card-body border-bottom">
                                <h6 class="text-muted"><?php echo app('translator')->get('Payment'); ?>: <span class="text-success">Наличными</span></h6>
                                <p>
                                    <?php echo app('translator')->get('Subtotal'); ?>: <?php echo e($order->total); ?> с. <br>
                                    <?php echo e($order->delivery_type); ?>:  <?php echo e($order->delivery_price); ?> с. <br>
                                    <strong><?php echo app('translator')->get('Total'); ?>: <?php echo e($order->general_total); ?> с. </strong>
                                </p>
                            </div>
                            <div class="table-responsive table-hover">
                                <table class="table table-borderless table-shopping-cart">
                                    <thead class="text-muted">
                                    <tr class="small text-uppercase">
                                        <th scope="col">ТОВАР</th>
                                        <th scope="col" width="145">Кол-во / Цена</th>
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
                                                        <a href="<?php echo e(route('guest.product', $product->id)); ?>" class="title"><?php echo e($product->name); ?></a>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td><?php echo e($product->pivot->quantity); ?> <i class="las la-times" style="font-size: 12px"></i> <?php echo e($product->price); ?> с.</td>
                                            <td><?php echo e($product->price * $product->pivot->quantity); ?> с.</td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mb-4">
                                <a href="<?php echo e(route('customer.order.show', $order->id)); ?>" class="btn btn-outline-primary">Подробнее</a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col">
                        <div class="my-5 py-5 text-center">
                            <h3 class="mb-3">Ничего не найдено.</h3>
                            <a href="<?php echo e(route('guest.index')); ?>" class="btn btn-primary">Продолжить покупки</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($orders->withQueryString()->links()); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/customer/order/index.blade.php ENDPATH**/ ?>