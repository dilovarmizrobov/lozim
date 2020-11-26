<?php $__env->startSection('content'); ?>
<div class="container py-4">
	<div class="row mb-4">
		<div class="col-lg-8 offset-lg-2">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <h3 class="mb-3">Заказ: #<?php echo e($order->id); ?></h3>
                </div>
                <div class="col-auto">
                    <a href="<?php echo e(route('admin.order.index')); ?>" class="btn btn-sm btn-outline-primary">Назад</a>
                </div>
            </div>
			<h4 class="my-3 font-weight-light">Заказчик</h4>
			<div class="row mx-0 py-2">
				<div class="col-6">Имя</div>
				<div class="col-auto"><h6><?php echo e($order->name); ?></h6></div>
			</div>
			<div class="row border-top mx-0 py-2">
				<div class="col-6">Телефон</div>
				<div class="col-auto"><h6><?php echo e($order->phone); ?></h6></div>
			</div>
            <div class="row border-top mx-0 py-2">
                <div class="col-6">Адрес</div>
                <div class="col-auto"><h6><?php echo e($order->address); ?></h6></div>
            </div>
            <div class="row border-top mx-0 py-2">
                <div class="col-6">Комментарии к заказу</div>
                <div class="col-auto"><h6><?php echo e($order->comment); ?></h6></div>
            </div>
			<div class="row border-top mx-0 py-2">
				<div class="col"><h5>Дата:</h5></div>
				<div class="col-auto"><h6><?php echo e($order->data); ?></h6></div>
			</div>
            <div class="row align-items-center">
                <div class="col-auto">
                    <h4 class="my-3 font-weight-light">Заказ</h4>
                </div>
                <div class="col-auto">
                    <select class="form-control form-control-sm orderStatus <?php echo e($order->status->id == 1 ? 'bg-light' : ($order->status->id == 2 ? 'bg-success text-white' : 'bg-danger text-white')); ?>" data-id="<?php echo e($order->id); ?>">
                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($status->id == $order->status->id ? 'selected' : ''); ?> value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
			<?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row border-bottom mx-0 py-2">
					<div class="col"><a class="text-dark" href=<?php echo e(route('guest.product', $product->id)); ?>><?php echo e($product->name); ?></a></div>
					<div class="col-auto"><?php echo e($product->pivot->quantity); ?> шт.</div>
					<div class="col-auto"><h6><?php echo e($product->price); ?> сом.</h6></div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<div class="row mx-0 py-2">
				<div class="col"><h5>Итог:</h5></div>
				<div class="col-auto"><h5><?php echo e($order->total); ?> сом.</h5></div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/order/show.blade.php ENDPATH**/ ?>