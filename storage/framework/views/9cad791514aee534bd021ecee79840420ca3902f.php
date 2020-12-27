<?php $__env->startSection('content'); ?>
	<div class="container my-4">
		<div class="row">
			<div class="col-sm-3"><h3>Отзывы</h3></div>
		</div>
		<div class="mt-4">
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
		    <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Обращения</th>
                        <th scope="col">Тип обращения</th>
                        <th scope="col">Дата обращения</th>
                        <th scope="col">Отзыв</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
		        <tbody>
                    <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($feedback->id); ?></th>
                            <td><?php echo e($feedback->appeal); ?></td>
                            <td><?php echo e($feedback->categoryAppeal); ?></td>
                            <td><?php echo e($feedback->data); ?></td>
                            <td><?php echo e($feedback->review); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.feedback.show', $feedback->id)); ?>" class="btn btn-primary">Посмотреть</a>
                                <form style="display: inline-block;" action="<?php echo e(route('admin.feedback.destroy', $feedback->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>

                                    <input type="hidden" name="_method" value="delete" />
                                    <button class="btn btn-danger" type="submit">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		        </tbody>
		    </table>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/feedback/index.blade.php ENDPATH**/ ?>