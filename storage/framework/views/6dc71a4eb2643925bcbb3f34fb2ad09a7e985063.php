<footer class="section-footer border-top bg-light">
    <div class="main-container">
        <div class="container-fluid">
            <section class="footer-top mt-4">
                <div class="row">
                    <aside class="col">
                        <h6 class="title"><?php echo e(env('APP_NAME')); ?></h6>
                        <ul class="list-unstyled">
                            <li> <a href="#">О сервисе</a></li>
                            <li> <a href="#">Правила и безопасность</a></li>
                            <li> <a href="<?php echo e(route('guest.feedback.create')); ?>">Связаться с нами</a></li>
                        </ul>
                    </aside>
                    <aside class="col">
                        <h6 class="title">Информация</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">Заказать</a></li>
                            <li> <a href="#">Оплатить</a></li>
                            <li> <a href="#">Получить</a></li>
                            <li> <a href="#">Доставка</a></li>
                        </ul>
                    </aside>
                    <aside class="col">
                        <h6 class="title"><?php echo app('translator')->get('Account'); ?></h6>
                        <ul class="list-unstyled">
                            <li> <a href="<?php echo e(route('login')); ?>"><?php echo app('translator')->get('User Login'); ?></a></li>
                            <li> <a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->get('User register'); ?></a></li>
                            <li> <a href="<?php echo e(route('customer.profile.index')); ?>"><?php echo app('translator')->get('Account Setting'); ?></a></li>
                            <li> <a href="<?php echo e(route('customer.order.index')); ?>"><?php echo app('translator')->get('My Orders'); ?></a></li>
                        </ul>
                    </aside>
                    <aside class="col">
                        <h6 class="title">Social</h6>
                        <ul class="list-unstyled">
                            <li><a href="#"> <i class="fab fa-facebook"></i> Facebook </a></li>
                            <li><a href="#"> <i class="fab fa-twitter"></i> Twitter </a></li>
                            <li><a href="#"> <i class="fab fa-instagram"></i> Instagram </a></li>
                            <li><a href="#"> <i class="fab fa-youtube"></i> Youtube </a></li>
                        </ul>
                    </aside>
                </div>
            </section>
            <section class="footer-bottom row">
                <div class="col-auto">
                    <p class="text-muted"> © 2020 <?php echo e(env('APP_NAME')); ?></p>
                </div>
                <div class="col-auto text-muted">
                    <span class="px-2">info@lozim.store</span>
                    <span class="px-2">+992-900-00-00-00</span>
                </div>
            </section>
        </div>
    </div>
</footer>
<?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/footer.blade.php ENDPATH**/ ?>