<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row my-4 align-items-center">
            <div class="col-auto">
                <h4 class="text-center font-weight-light">Добавить атрибут в категории</h4>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('admin.categories.properties.index', $category->id)); ?>" class="btn btn-sm btn-outline-primary">Назад</a>
            </div>
        </div>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $category->nonExistentProperties(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($property->id); ?></th>
                    <td><?php echo e($property->name); ?></td>
                    <td>
                        <form style="display: inline-block;" action="<?php echo e(route('admin.categories.properties.store', $category->id)); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="property_id" value="<?php echo e($property->id); ?>" />
                            <button class="btn btn-sm btn-outline-dark" type="submit">Добавить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/category/property/create.blade.php ENDPATH**/ ?>