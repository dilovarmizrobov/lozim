<?php $__env->startSection('content'); ?>
    <section class="bg-light py-2 mt-3">
        <div class="main-container">
            <div class="container-fluid">
                <nav>
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a class="text-dark" href="<?php echo e(route('guest.index')); ?>">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($searchText); ?></li>
                    </ol>
                </nav>
                <h4 class="title-page">Результаты поиска по запросу " <?php echo e($searchText); ?> " ( <?php echo e($products->total()); ?> )</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5 mt-2">
        <div class="container-fluid">
            <header class="border-bottom mb-4 pb-3">
                <div class="row no-gutters">
                    <div class="col-auto mr-2">
                        <?php if($sort === 'newly'): ?>
                            <span class="text-success">Новые</span>
                        <?php else: ?>
                            <a href="<?php echo e(route('guest.search', ['search' => $searchText, 'sort' => 'newly'])); ?>" class="text-dark">Новые</a>
                        <?php endif; ?>
                    </div>
                    <div class="col-auto mr-2">
                        <?php if($sort === 'priceup'): ?>
                            <span class="text-success">Дешевые</span>
                        <?php else: ?>
                            <a href="<?php echo e(route('guest.search', ['search' => $searchText, 'sort' => 'priceup'])); ?>" class="text-dark">Дешевые</a>
                        <?php endif; ?>
                    </div>
                    <div class="col-auto mr-2">
                        <?php if($sort === 'pricedown'): ?>
                            <span class="text-success">Дорогие</span>
                        <?php else: ?>
                            <a href="<?php echo e(route('guest.search', ['search' => $searchText, 'sort' => 'pricedown'])); ?>" class="text-dark">Дорогие</a>
                        <?php endif; ?>
                    </div>
                </div>
            </header>
            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-4 col-lg-3">
                        <?php echo $__env->make('product.middle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col my-5 py-5 text-center">
                        По вашему запросу ничего не найдено!
                    </div>
                <?php endif; ?>
            </div>
            <div class="mt-4">
                <?php echo e($products->withQueryString()->links()); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/guest/search.blade.php ENDPATH**/ ?>