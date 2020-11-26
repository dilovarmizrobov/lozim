<?php $__env->startSection('content'); ?>
    <section class="p-3 my-3 bg-light">
        <div class="main-container">
            <div class="container-fluid">
                <h3 class="title-page">Вход в личный кабинет</h3>
            </div>
        </div>
    </section>
    <section class="main-container mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 border-right">
                    <h4 class="mb-4">Авторизация</h4>
                    <form class="formValidate" method="POST" action="<?php echo e(route('login')); ?>" novalidate>
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="formEmail">Электронный адрес</label>
                            <input id="formEmail" type="email" class="form-control w-75 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

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
                        <div class="form-group">
                            <label for="formPassword">Пароль</label>
                            <input id="formPassword" type="password" class="form-control w-75 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required>

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
                        </div>
                        <div class="form-group custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="custom-control-label" for="remember">Запомнить меня</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Войти</button>
                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">Забыли пароль?</a>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <h4 class="card-title mb-4">Регистрация</h4>
                    <h5></h5>
                    <p><span class="font-weight-bold">Рекомендуем Вам зарегистрироваться</span> в нашем интернет-магазине, чтобы не вводить каждый раз адресные данные при оформлении заказа. А также:</p>
                    <ul>
                        <li>В Вашем личном кабинете будет сохраняться история Ваших заказов</li>
                        <li>Вы сможете составлять список избранных товаров</li>
                    </ul>
                    <p>Личные сведения, полученные в распоряжении интернет-магазина www.brand.ru при регистрации или каким-либо иным образом, будут использованы исключительно для исполнения Ваших заказов, и не будут передаваться третьим организациям и лицам, без Вашего согласия, за исключением ситуаций, когда этого требует закон или судебное решение.</p>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/auth/login.blade.php ENDPATH**/ ?>