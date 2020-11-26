<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page"><?php echo app('translator')->get('Customer'); ?> #<?php echo e(auth()->user()->id); ?></h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <header class="section-heading">
                <a href="<?php echo e(route('customer.order.index')); ?>" class="btn btn-outline-primary float-right">See all</a>
                <h4 class="section-title">Заказы</h4>
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
                                    <?php echo app('translator')->get('Shipping fee'); ?>:  5 с. <br>
                                    <span class="b"><?php echo app('translator')->get('Total'); ?>: <?php echo e($order->total + 5); ?> с. </span>
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
    <section class="main-container mb-5">
        <div class="container-fluid">
            <header class="section-heading">
                <a href="<?php echo e(route('customer.favorite.index')); ?>" class="btn btn-outline-primary float-right">See all</a>
                <h4 class="section-title">Избранные товары</h4>
            </header>
            <div class="row">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-4 col-lg-3">
                        <div href="#" class="card card-product-grid">
                            <a href="#" class="img-wrap"><img src="<?php echo e($product->image_medium); ?>"></a>
                            <figcaption class="info-wrap">
                                <div class="fix-height">
                                    <a href="#" class="title"><?php echo e($product->truncateName); ?></a>
                                    <div class="price"><?php echo e($product->price); ?> с.</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="counter mr-3">
                                        <input id="counter<?php echo e($product->id); ?>" type="text" value="<?php echo e($product->quantityInCart); ?>" class="counter__field js-counter__number" maxlength="4">
                                        <div class="counter__arrow-block" role="group">
                                            <span class="counter__arrow js-counter__plus" data-counter="#counter<?php echo e($product->id); ?>"></span>
                                            <span class="counter__arrow counter__arrow-down js-counter__minus" data-counter="#counter<?php echo e($product->id); ?>"></span>
                                        </div>
                                    </div>
                                    <div class="mr-3">
                                        <button class="btn btn-sm btn-block btn-outline-primary js-product-tocart" data-url="<?php echo e(route('cart.add')); ?>" data-counter="#counter<?php echo e($product->id); ?>" data-product-id="<?php echo e($product->id); ?>">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-block btn-outline-primary js-product-tofavorite" data-url="<?php echo e(route('customer.favorite.toggle', $product->id)); ?>">
                                            <?php if($product->isFavorite): ?>
                                                <i class="fas fa-heart"></i>
                                            <?php else: ?>
                                                <i class="far fa-heart"></i>
                                            <?php endif; ?>
                                        </button>
                                    </div>
                                </div>
                            </figcaption>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/customer/index.blade.php ENDPATH**/ ?>