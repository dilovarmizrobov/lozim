<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row my-4 align-items-center">
            <div class="col-auto">
                <h4 class="text-center font-weight-light">Каталог</h4>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-sm btn-outline-primary">Назад</a>
            </div>
        </div>
        <?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?>
        <form action="<?php echo e(route('admin.categories.store', ['parent_id'=>request()->parent_id])); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="mb-4 ml-2">
                <div class="form-group row">
                    <div class="col-lg-2">Название категории</div>
                    <div class="col-7 col-lg-4">
                        <input class="form-control form-control-sm" name="name" value="<?php echo e(old('name')); ?>" type="text">
                        <?php if($errors->has('name')): ?>
                            <span class="font-weight-bold small"><?php echo e($errors->first('name')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <button class="btn btn-sm btn-primary shadow" type="submit">Добавить</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/category/create.blade.php ENDPATH**/ ?>