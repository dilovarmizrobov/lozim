<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Избранные товары</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
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

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/customer/favorite.blade.php ENDPATH**/ ?>