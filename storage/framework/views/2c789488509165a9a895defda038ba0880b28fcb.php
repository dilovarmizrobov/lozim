<?php $__env->startComponent('mail::message'); ?>
Здравствуйте!

Вы получили это письмо, потому что мы получили запрос на изменение Вашего e-mail адреса.

Подтвердите, пожалуйста, изменение Вашего e-mail перейдя по ссылке ниже:
<?php $__env->startComponent('mail::button', ['url' => route('email.reset', $token), 'color' => 'blue']); ?>
    Подтвердить
<?php if (isset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e)): ?>
<?php $component = $__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e; ?>
<?php unset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
С уважением,<br><?php echo e(config('app.name')); ?>

<?php $__env->startComponent('mail::subcopy'); ?>
    Если у вас возникли проблемы с нажатием кнопки "Подтвердить" скопируйте и вставьте приведенный
    ниже URL-адрес в веб-браузер: [<?php echo e(route('email.reset', $token)); ?>](<?php echo route('email.reset', $token); ?>)
<?php if (isset($__componentOriginalba845ad32dfe5e4470519a452789aeb20250b6fc)): ?>
<?php $component = $__componentOriginalba845ad32dfe5e4470519a452789aeb20250b6fc; ?>
<?php unset($__componentOriginalba845ad32dfe5e4470519a452789aeb20250b6fc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php if (isset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d)): ?>
<?php $component = $__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d; ?>
<?php unset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/emails/reset_email.blade.php ENDPATH**/ ?>