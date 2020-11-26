<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h4 class="title-page">Личный кабинет</h4>
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
                <div class="col-6 border-right">
                    <h5 class="mb-4 font-weight-normal">Основные данные</h5>
                    <form class="formValidate" method="POST" action="<?php echo e(route('customer.profile.update')); ?>" novalidate>
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label for="formName">Имя</label>
                            </div>
                            <div class="col">
                                <input id="formName" type="text" class="form-control form-control-sm <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name') ?? $user->customer->name); ?>" required>

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
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label for="formPhone">Телефон</label>
                            </div>
                            <div class="col">
                                <input id="formPhone" type="tel" class="form-control form-control-sm <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone" value="<?php echo e(old('phone') ?? $user->customer->phone); ?>" required>

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
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label for="formAddress">Адрес</label>
                            </div>
                            <div class="col">
                                <input id="formAddress" type="text" class="form-control form-control-sm <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address" value="<?php echo e(old('address') ?? $user->customer->address); ?>" required>

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
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-sm btn-primary">Изменить</button>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <h5 class="mb-4 font-weight-normal">Параметры входа</h5>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>Эл. адрес</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" value=<?php echo e($user->email); ?> disabled>

                            <?php $__errorArgs = ['email'];
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
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary btn-sm shadow" data-toggle="modal" data-target="#emailEditModal">Изменить</button>
                            <div class="modal fade" id="emailEditModal" tabindex="-1" role="dialog" aria-labelledby="emailEditModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form class="formValidate" method="POST" action="<?php echo e(route('email.email')); ?>" novalidate>
                                            <?php echo csrf_field(); ?>

                                            <div class="modal-header">
                                                <h5 class="modal-title">Изменить</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-sm-4">Эл. адрес</div>
                                                        <div class="col-sm-8">
                                                            <input name="email" type="email" class="form-control form-control-sm" value="<?php echo e($user->email); ?>" autocomplete="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Отменить</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>Пароль</label>
                        </div>
                        <div class="col">
                            <input type="password" class="form-control form-control-sm" placeholder="******" disabled>

                            <?php $__errorArgs = ['password'];
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

                            <?php $__errorArgs = ['new_password'];
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
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary btn-sm shadow" data-toggle="modal" data-target="#passwordEditModal">Изменить</button>
                            <div class="modal fade" id="passwordEditModal" tabindex="-1" role="dialog" aria-labelledby="passwordEditModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form class="formValidate" action="<?php echo e(route('customer.profile.password.update')); ?>" method="post" novalidate>
                                            <?php echo csrf_field(); ?>

                                            <div class="modal-header">
                                                <h5 class="modal-title">Изменить</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="form-group form-row">
                                                        <div class="col-sm-4">
                                                            <label for="formPassword">Текущий пароль</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input id="formPassword" name="password" type="password" class="form-control form-control-sm" placeholder="******" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <div class="col-sm-4">
                                                            <label for="formNewPassword">Новый пароль</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input id="formNewPassword" name="new_password" type="password" class="form-control form-control-sm" placeholder="******" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-row">
                                                        <div class="col-sm-4">
                                                            <label for="formNewPasswordConfirmation">Подтверждение пароля</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input id="formNewPasswordConfirmation" name="new_password_confirmation" type="password" class="form-control form-control-sm" placeholder="******" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Отменить</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/customer/profile.blade.php ENDPATH**/ ?>