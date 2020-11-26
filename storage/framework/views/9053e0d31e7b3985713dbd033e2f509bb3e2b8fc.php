<?php $__env->startSection('content'); ?>
	<div class="container">
        <div class="row my-4 align-items-center">
            <div class="col-auto">
                <h3 class="font-weight-normal"><a class="text-dark" href="<?php echo e(route('admin.product.index')); ?>">Продукты</a></h3>
            </div>
            <div class="col-auto">
                <a class="btn btn-sm btn-outline-primary" href="<?php echo e(route('admin.product.create')); ?>">Создать</a>
            </div>
            <div class="col-sm-auto ml-auto mt-4 mt-sm-0">
                <form action="<?php echo e(route('admin.product.index')); ?>" method="get">
                    <div class="row no-gutters">
                        <div class="col mr-3">
                            <input class="form-control form-control-sm" name="search" type="text" value="<?php echo e(request()->search); ?>" placeholder="Название товара">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(request()->has('search') && !is_null(request()->search)): ?>
            <div class="mb-4">
                <h5 class="font-weight-normal">Результаты поиска: " <?php echo e(request()->search); ?> "</h5>
            </div>
        <?php endif; ?>
        <div class="row mb-3">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 text-center">
                        <div class="p-3">
                            <a href="<?php echo e(route('guest.product', $product->id)); ?>">
                                <img style="max-width: 150px; max-height: 150px;" src="<?php echo e($product->image_medium); ?>" alt="">
                            </a>
                        </div>
                        <div class="mx-2">
                            <h6 class="card-title"><a class="text-dark" href="<?php echo e(route('guest.product', $product->id)); ?>"><?php echo e($product->name); ?></a></h6>
                            <h6 class="font-weight-light"><?php echo e($product->price); ?> сом.</h6>
                        </div>
                        <div class="mt-auto mb-3">
                            <hr class="w-75">
                            <a href="<?php echo e(route('admin.product.edit', $product->id)); ?>" class="btn btn-sm btn-outline-dark">Изменить</a>
                            <form class="d-inline confirmAction" action="<?php echo e(route('admin.product.destroy', $product->id)); ?>" method="post">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="_method" value="delete" />
                                <button class="btn btn-sm btn-outline-dark" type="submit">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col">Сожалеем, но ничего не найдено.</div>
            <?php endif; ?>
        </div>
        <div class="d-flex justify-content-center">
            <?php echo e($products->appends(request()->input())->links('pagination::bootstrap-4')); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/product/index.blade.php ENDPATH**/ ?>