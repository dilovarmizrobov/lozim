<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row my-4 align-items-center">
            <div class="col-auto">
                <h3 class="font-weight-normal"><a class="text-dark" href="<?php echo e(route('admin.properties.index')); ?>">Атрибуты</a></h3>
            </div>
            <div class="col-auto">
                <a class="btn btn-sm btn-outline-primary" href="<?php echo e(route('admin.properties.create')); ?>">Создать</a>
            </div>
            <div class="col-sm-auto ml-auto mt-4 mt-sm-0">
                <form action="<?php echo e(route('admin.properties.index')); ?>" method="get">
                    <div class="row no-gutters">
                        <div class="col mr-3">
                            <input class="form-control form-control-sm" name="search" type="text" value="<?php echo e(request()->search); ?>" placeholder="Имя атрибута">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-primary"><span class="oi oi-magnifying-glass"></span></button>
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
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Значений атрибута</th>
                <th scope="col">Описания</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($property->id); ?></th>
                    <td><?php echo e($property->name); ?></td>
                    <td><?php echo e($property->values->count()); ?> - <a href="<?php echo e(route('admin.properties.property_values.index', $property->id)); ?>">редактировать</a></td>
                    <td><?php echo e($property->description); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.properties.edit', $property->id)); ?>" class="btn btn-sm btn-outline-dark">Изменить</a>
                        <form style="display: inline-block;" action="<?php echo e(route('admin.properties.destroy', $property->id)); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="_method" value="delete" />
                            <button class="btn btn-sm btn-outline-dark" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/property/index.blade.php ENDPATH**/ ?>