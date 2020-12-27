<?php $__env->startSection('content'); ?>
    <section class="bg-light py-2 mt-3">
        <div class="main-container">
            <div class="container-fluid">
                <nav>
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a class="text-dark" href="<?php echo e(route('guest.index')); ?>">Главная</a></li>
                        <?php $__currentLoopData = $array_breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($loop->last): ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($breadcrumb['title']); ?></li>
                            <?php else: ?>
                                <li class="breadcrumb-item"><a class="text-dark" href="<?php echo e(route('guest.category', $breadcrumb['href'])); ?>"><?php echo e($breadcrumb['title']); ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </nav>
                <h4 class="title-page"><?php echo e($category->name); ?></h4>
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
                            <a href="<?php echo e(route('guest.category', ['slug'=> request()->slug, 'sort' => 'newly'])); ?>" class="text-dark">Новые</a>
                        <?php endif; ?>
                    </div>
                    <div class="col-auto mr-2">
                        <?php if($sort === 'priceup'): ?>
                            <span class="text-success">Дешевые</span>
                        <?php else: ?>
                            <a href="<?php echo e(route('guest.category', ['slug'=> request()->slug, 'sort' => 'priceup'])); ?>" class="text-dark">Дешевые</a>
                        <?php endif; ?>
                    </div>
                    <div class="col-auto mr-2">
                        <?php if($sort === 'pricedown'): ?>
                            <span class="text-success">Дорогие</span>
                        <?php else: ?>
                            <a href="<?php echo e(route('guest.category', ['slug'=> request()->slug, 'sort' => 'pricedown'])); ?>" class="text-dark">Дорогие</a>
                        <?php endif; ?>
                    </div>
                </div>
            </header>
            <div class="row">
                <div class="col-4 col-lg-3">
                    <div class="filter-widget">
                        <div class="fwc-title active">
                            <span><?php echo e($category->name); ?></span>
                            <ul class="filter-catagories ml-2">
                                <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('guest.category', $child->get_full_slug())); ?>"><?php echo e($child->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="filter-catagories">
                            <?php $__currentLoopData = $category->neighbors(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $neighbor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($category->id == $neighbor->id): ?>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <a class="fwc-title" href="<?php echo e(route('guest.category', $neighbor->get_full_slug())); ?>"><?php echo e($neighbor->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-6 col-lg-4">
                                <?php echo $__env->make('product.middle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <?php echo e($products->withQueryString()->links()); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/guest/category.blade.php ENDPATH**/ ?>