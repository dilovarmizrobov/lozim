<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row my-4 align-items-center">
            <div class="col-auto"><h3 class="font-weight-light">Каталог</h3></div>
        </div>
        <?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div><br />
        <?php endif; ?>
        <div class="mb-3 border py-2 px-3">
            <div class="cat-menu" data-menu-id="0">
                <div class="row no-gutters mb-2">
                    <div class="col-auto">
                        <h4 class="font-weight-light">
                            Все категории
                        </h4>
                    </div>
                    <div class="col-auto ml-3">
                        <a type="button" class="btn btn-sm btn-outline-dark" href="<?php echo e(route('admin.categories.create', ['parent_id'=>'null'])); ?>">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <?php $__currentLoopData = $categories->getIndexCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row no-gutters mb-2">
                        <div class="col-auto">
                            <button class="btn btn-sm cat-next-menu" data-next-menu-id="<?php echo e($category->id); ?>" data-menu-id="0">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="col-auto mr-4">
                            <h4 class="font-weight-light">
                                <a class="text-dark" href="<?php echo e(route('admin.categories.properties.index', $category->id)); ?>"><?php echo e($category->name); ?></a>
                            </h4>
                        </div>
                        <div class="col-auto">
                            <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" method="post">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('DELETE')); ?>

                                <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                                    <a type="button" class="btn btn-outline-dark" href="<?php echo e(route('admin.categories.edit', $category->id)); ?>">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button type="submit" class="btn btn-outline-dark">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php $__currentLoopData = $categories->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="cat-menu" data-menu-id="<?php echo e($category->id); ?>" style="display: none">
                        <div class="row no-gutters mb-2">
                            <div class="col-auto">
                                <button class="btn btn-sm cat-prev-menu" data-menu-id="<?php echo e($category->id); ?>" data-prev-menu-id="<?php echo e($category->parent ? $category->parent->id : 0); ?>">
                                    <span class="fas fa-arrow-left"></span>
                                </button>
                            </div>
                            <div class="col-auto">
                                <h4 class="font-weight-light">
                                    <a class="text-dark" href="<?php echo e(route('admin.categories.properties.index', $category->id)); ?>"><?php echo e($category->name); ?></a>
                                </h4>
                            </div>
                            <div class="col-auto ml-2">
                                <a type="button" class="btn btn-sm btn-outline-dark" href="<?php echo e(route('admin.categories.create', ['parent_id'=>$category->id])); ?>">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row no-gutters mb-2">
                                <div class="col-auto">
                                    <button class="btn btn-sm cat-next-menu" data-menu-id="<?php echo e($category->id); ?>" data-next-menu-id="<?php echo e($children->id); ?>">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </div>
                                <div class="col-auto mr-4">
                                    <h4 class="font-weight-light">
                                        <a class="text-dark" href="<?php echo e(route('admin.categories.properties.index', $children->id)); ?>"><?php echo e($children->name); ?></a>
                                    </h4>
                                </div>
                                <div class="col-auto">
                                    <form action="<?php echo e(route('admin.categories.destroy', $children->id)); ?>" method="post">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                        <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                                            <a type="button" class="btn btn-outline-dark" href="<?php echo e(route('admin.categories.edit', $children->id)); ?>">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="submit" class="btn btn-outline-dark">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <script>
        window.onload = function () {
            $('.cat-next-menu').click(function (e) {
                let self = $(this);
                $(".cat-menu[data-menu-id=" + self.data().menuId + "]").fadeOut(0),
                $(".cat-menu[data-menu-id=" + self.data().nextMenuId + "]").fadeIn();
            });

            $('.cat-prev-menu').click(function (e) {
                let self = $(this);
                $(".cat-menu[data-menu-id=" + self.data().menuId + "]").fadeOut(0);
                $(".cat-menu[data-menu-id=" + self.data().prevMenuId + "]").fadeIn();
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/category/index.blade.php ENDPATH**/ ?>