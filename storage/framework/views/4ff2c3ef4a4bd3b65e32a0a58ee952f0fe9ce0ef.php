<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Корзина</h3>
            </div>
        </div>
    </section>
    <section class="section-content padding-y">
        <div class="main-container">
            <div class="container-fluid">
                <?php if(session('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if(Cart::content()->isNotEmpty()): ?>
                    <div class="card">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col">Товар</th>
                                    <th scope="col" width="100">Цена</th>
                                    <th scope="col" width="145">Количество</th>
                                    <th scope="col" width="100">Сумма</th>
                                    <th scope="col" width="80"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <figure class="itemside">
                                            <div class="aside"><img src="<?php echo e($product->model->image_medium); ?>" class="img-sm"></div>
                                            <figcaption class="info">
                                                <a href="<?php echo e(route('guest.product', $product->id)); ?>" class="title"><?php echo e($product->name); ?></a>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>
                                        <div class="price-wrap">
                                            <span class="price"><?php echo e($product->price); ?> с.</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="counter mr-3">
                                                <input id="counter<?php echo e($product->id); ?>" type="text" value="<?php echo e($product->model->quantityInCart); ?>" class="counter__field js-counter__number" maxlength="4">
                                                <div class="counter__arrow-block" role="group">
                                                    <span class="counter__arrow js-counter__plus" data-counter="#counter<?php echo e($product->id); ?>"></span>
                                                    <span class="counter__arrow counter__arrow-down js-counter__minus" data-counter="#counter<?php echo e($product->id); ?>"></span>
                                                </div>
                                            </div>
                                            <div class="mr-2">
                                                <button class="btn btn-sm btn-block btn-outline-primary js-product-edit-count-in-cart" data-url="<?php echo e(route('cart.add')); ?>" data-counter="#counter<?php echo e($product->id); ?>" data-product-id="<?php echo e($product->id); ?>" data-price="<?php echo e($product->price); ?>" data-subtotal-href="#js-product-subtotal-<?php echo e($product->id); ?>">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-block btn-outline-primary js-product-tofavorite" data-url="<?php echo e(route('customer.favorite.toggle', $product->id)); ?>">
                                                    <?php if($product->model->isFavorite): ?>
                                                        <i class="fas fa-heart"></i>
                                                    <?php else: ?>
                                                        <i class="far fa-heart"></i>
                                                    <?php endif; ?>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price-wrap">
                                            <span class="price"><span id="js-product-subtotal-<?php echo e($product->id); ?>"><?php echo e($product->price * $product->qty); ?></span> с.</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" action="<?php echo e(route('cart.remove', $product->rowId)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="las la-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="card-body border-top">
                            <div class="d-flex pt-2">
                                <h5 class="mr-3 ml-auto">Сумма заказов:</h5>
                                <h5><span class="header_total_price"><?php echo e(Cart::subtotal()); ?></span> с.</h5>
                            </div>
                            <div class="d-flex pb-4 pt-2 align-items-center">
                                <span class="ml-auto">
                                    <button class="btn btn-sm" data-toggle="popover" data-placement="left" data-trigger="focus" data-content="Бесплатная доставка при заказа свыше <?php echo e($delivery_from); ?> сомони."><i class="fas fa-info-circle"></i></button>
                                </span>
                                <span class="mr-2">Доставка:</span>
                                <span class="font-weight-bold">
                                    <span class="freeShipping<?php echo e($hasFreeShipping ? '' : ' d-none'); ?>">бесплатно.</span>
                                    <span class="paidShipping<?php echo e(!$hasFreeShipping ? '' : ' d-none'); ?>"><?php echo e($delivery_price); ?> с.</span>
                                </span>
                            </div>
                            <div>
                                <a href="<?php echo e(route('customer.checkout.index')); ?>" class="btn btn-primary float-md-right">Оформить заказ <i class="fa fa-chevron-right"></i></a>
                                <a href="<?php echo e(route('guest.index')); ?>" class="btn btn-light border"><i class="fa fa-chevron-left"></i> Продолжить покупки</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="my-5 text-center">
                        <h3 class="mb-3">Ваша корзина пуста!</h3>
                        <a href="<?php echo e(route('guest.index')); ?>" class="btn btn-primary">Продолжить покупки</a>
                    </div>
                <?php endif; ?>
                <div class="alert alert-success mt-4">
                    <p class="icontext"><i class="icon text-success fa fa-truck"></i> Бесплатная доставка при заказа свыше <?php echo e($delivery_from); ?> сомони.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-name bg-light py-3 my-5">
        <div class="main-container">
            <div class="container-fluid">
                <h6>Payment and refund policy</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/guest/cart.blade.php ENDPATH**/ ?>