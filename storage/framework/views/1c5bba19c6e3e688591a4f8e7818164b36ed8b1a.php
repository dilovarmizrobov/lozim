<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Оформление заказа</h4>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <?php if(session('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-7 mb-4">
                    <section>
                        <h5 class="mb-3">Ваш заказ</h5>
                        <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row border-bottom mx-0 py-2">
                                <div class="col"><a class="text-dark" href="<?php echo e(route('guest.product', $product->id)); ?>"><?php echo e($product->name); ?></a></div>
                                <div class="col-auto">
                                    <span><?php echo e($product->qty); ?></span>
                                    <i class="las la-times" style="font-size: 12px"></i>
                                    <span><?php echo e($product->price); ?> с.</span>
                                    <i class="las la-long-arrow-alt-right" style="font-size: 12px"></i>
                                    <span><?php echo e($product->price * $product->qty); ?> с.</span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="row mx-0 py-2">
                            <div class="col-auto ml-auto">Сумма заказов:</div>
                            <div class="col-auto font-weight-bold"><?php echo e(Cart::subtotal()); ?> с.</div>
                        </div>
                    </section>
                    <section>
                        <h5 class="mb-3">Тип доставки</h5>
                        <div class="row mx-0 py-2">
                            <div class="col">
                                <div class="custom-control custom-switch">
                                    <input type="radio" name="checkoutDelivery" value="regular" class="custom-control-input" id="regularDelivery" data-price="<?php echo e($delivery_price); ?>" checked>
                                    <label class="custom-control-label" for="regularDelivery">Обычная доставка</label>
                                    <a data-toggle="collapse" href="#regularDeliveryCollapse" aria-expanded="false" aria-controls="regularDeliveryCollapse"><i class="fas fa-info-circle"></i></a>
                                    <div class="collapse" id="regularDeliveryCollapse">
                                        <p class="mt-2 small">
                                            При сумме заказа свыше <?php echo e($delivery_from); ?> сомони – ДОСТАВКА БЕСПЛАТНАЯ!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto regularDeliveryPrice"><span class="font-weight-bold"><?php echo e($hasFreeShipping ? 'бесплатно.' : "$delivery_price с."); ?></span></div>
                        </div>
                        <div class="row mx-0 py-2">
                            <div class="col">
                                <div class="custom-control custom-switch">
                                    <input type="radio" name="checkoutDelivery" value="express" class="custom-control-input" id="expressDelivery" data-price="<?php echo e($delivery_express_price); ?>">
                                    <label class="custom-control-label" for="expressDelivery">Срочная доставка</label>
                                    <a data-toggle="collapse" href="#expressDeliveryCollapse" aria-expanded="false" aria-controls="expressDeliveryCollapse"><i class="fas fa-info-circle"></i></a>
                                    <div class="collapse" id="expressDeliveryCollapse">
                                        <p class="mt-2 small">
                                            Время доставки 2-3 ч.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto expressDeliveryPrice d-none"><span class="font-weight-bold"><?php echo e($delivery_express_price); ?> с.</span></div>
                        </div>
                        <div class="row border-top mt-2 mx-0 py-2 font-weight-bold">
                            <div class="col-auto ml-auto">ИТОГО:</div>
                            <div class="col-auto"><span class="checkoutTotal"><?php echo e($total); ?></span> с.</div>
                            <input type="hidden" name="checkoutTotal" value="<?php echo e(Cart::subtotal()); ?>">
                        </div>
                    </section>
                </div>
                <div class="col-5">
                    <h5 class="mb-3">Ваши данные</h5>
                    <form class="formValidate" method="POST" action="<?php echo e(route('customer.checkout.store')); ?>" novalidate>
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="formName">Имя *</label>
                            <input id="formName" type="text" class="form-control form-control-sm <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name') ?? Auth::user()->customer->name); ?>" required>

                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="formPhone">Телефон *</label>
                            <input id="formPhone" type="tel" class="form-control form-control-sm <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone" value="<?php echo e(old('phone') ?? Auth::user()->customer->phone); ?>" required>

                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="formAddress">Адрес *</label>
                            <input id="formAddress" type="text" class="form-control form-control-sm <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address" value="<?php echo e(old('address') ?? Auth::user()->customer->address); ?>" required>

                            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="formComment">Комментарии к заказу</label>
                            <textarea id="formComment" class="form-control form-control-sm" name="comment"></textarea>
                        </div>
                        <div class="form-group custom-control custom-checkbox">
                            <input id="formContactAgree" type="checkbox" class="custom-control-input <?php $__errorArgs = ['contactAgree'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="contactAgree" required>
                            <label for="formContactAgree" class="custom-control-label">Я ознакомлен с содержанием пользовательского соглашения.</label>

                            <?php $__errorArgs = ['contactAgree'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <input type="hidden" name="delivery" value="regular">
                        <button type="submit" class="btn btn-primary">Оформить заказ</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/customer/checkout.blade.php ENDPATH**/ ?>