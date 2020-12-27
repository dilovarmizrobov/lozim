<?php $__env->startSection('content'); ?>
	<div class="container my-4">
		<div class="row">
			<div class="col-sm-3"><h3><a class="text-dark" href="<?php echo e(route('admin.order.index')); ?>">Заказы</a></h3></div>
            <div class="col-sm-auto ml-auto mt-4 mt-sm-0">
                <form action="<?php echo e(route('admin.order.index')); ?>" method="get">
                    <div class="row no-gutters">
                        <div class="col mr-3">
                            <input class="form-control form-control-sm" name="search" type="text" value="<?php echo e(request()->search); ?>" placeholder="ID заказа">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
		<div class="mt-4">
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

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
                        <th scope="col">Телефон</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Дата</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="<?php echo e($loop->index % 2 != 0 ? 'bg-light' : ''); ?>">
                            <th scope="row"><?php echo e($order->id); ?></th>
                            <td><a class="text-dark" style="text-decoration: underline" href=<?php echo e(route('admin.order.show', $order->id)); ?>><?php echo e($order->name); ?></a></td>
                            <td><?php echo e($order->phone); ?></td>
                            <td>
                                <select class="form-control form-control-sm orderStatus <?php echo e($order->status->id == 1 ? 'bg-light' : ($order->status->id == 2 ? 'bg-secondary text-white' : ($order->status->id == 3 ? 'bg-success text-white' : 'bg-danger text-white') )); ?>" data-id="<?php echo e($order->id); ?>">
                                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($status->id == $order->status->id ? 'selected' : ''); ?> value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td><?php echo e($order->dateAndTime); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td>Сожалеем, но ничего не найдено.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/order/index.blade.php ENDPATH**/ ?>