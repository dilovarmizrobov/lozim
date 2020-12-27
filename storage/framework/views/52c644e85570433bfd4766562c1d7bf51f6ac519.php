<?php $__env->startSection('content'); ?>
<div class="container py-4">
	<div class="row mb-5">
		<div class="col-lg-8 offset-lg-2">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <h3 class="mb-3">Заказ: #<?php echo e($order->id); ?></h3>
                </div>
                <div class="col-auto">
                    <a href="<?php echo e(route('admin.order.index')); ?>" class="btn btn-sm btn-outline-primary">Назад</a>
                </div>
            </div>
			<h4 class="mt-3">Заказчик</h4>
			<div class="ml-3">
                <div class="row border-bottom py-2">
                    <div class="col-6">Имя</div>
                    <div class="col-auto"><?php echo e($order->name); ?></div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-6">Телефон</div>
                    <div class="col-auto"><?php echo e($order->phone); ?></div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-6">Адрес</div>
                    <div class="col-auto"><?php echo e($order->address); ?></div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-6">Комментарии к заказу</div>
                    <div class="col-auto"><?php echo e($order->comment); ?></div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-6">Время и дата:</div>
                    <div class="col-auto"><h6><?php echo e($order->data); ?></h6></div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-auto">
                    <h4>Заказ</h4>
                </div>
                <div class="col-auto">
                    <select class="form-control form-control-sm orderStatus <?php echo e($order->status->id == 1 ? 'bg-light' : ($order->status->id == 2 ? 'bg-success text-white' : 'bg-danger text-white')); ?>" data-id="<?php echo e($order->id); ?>">
                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($status->id == $order->status->id ? 'selected' : ''); ?> value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
			<div class="ml-3">
                <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row border-bottom py-2">
                        <div class="col"><a class="text-dark" href=<?php echo e(route('guest.product', $product->id)); ?>><?php echo e($product->name); ?></a></div>
                        <div class="col-auto">
                            <span><?php echo e($product->pivot->quantity); ?></span>
                            <i class="las la-times" style="font-size: 12px"></i>
                            <span><?php echo e($product->pivot->price); ?> с.</span>
                            <i class="las la-long-arrow-alt-right" style="font-size: 12px"></i>
                            <span><?php echo e($product->pivot->price * $product->pivot->quantity); ?> с.</span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="row py-2">
                    <div class="col"><h6>Сумма заказов:</h6></div>
                    <div class="col-auto"><h6><?php echo e($order->total); ?> с.</h6></div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-auto">
                    <h4>Доставка</h4>
                </div>
            </div>
            <div class="ml-3">
                <div class="row py-2 border-bottom">
                    <div class="col"><?php echo e($order->delivery_type); ?></div>
                    <div class="col-auto"><h6><?php echo e($order->delivery_price); ?> с.</h6></div>
                </div>
                <div class="text-center mt-5">
                    <h4>Итого: <?php echo e($order->generalTotal); ?> с.</h4>
                </div>
            </div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/order/show.blade.php ENDPATH**/ ?>