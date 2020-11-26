<?php $__env->startSection('content'); ?>
    <div class="container product-create">
        <div class="row my-4 align-items-center">
            <div class="col-auto">
                <h4 class="text-center font-weight-light">Создать продукт</h4>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('admin.product.index')); ?>" class="btn btn-sm btn-outline-primary">Назад</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <form class="formsValidate" action="<?php echo e(route('admin.product.store')); ?>" method="post"
                                                                            enctype="multipart/form-data" novalidate>
                    <?php echo e(csrf_field()); ?>

                    <?php if(!is_null($category)): ?>
                        <div class="form-group row">
                            <div class="col-auto">
                                <span class="fz-17">Категория <span class="font-weight-bold"><?php echo e($category->name); ?></span></span>
                            </div>
                            <div class="col-auto ml-auto">
                                <a data-toggle="collapse" href="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">Редактировать</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="form-group row">
                            <div class="col-auto">
                                <span class="fz-17">Категория</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group collapse<?php echo e(is_null($category) ? ' show' : ''); ?>" id="collapseCategories">
                        <div class="border px-3 py-3 shadow rounded">
                            <div class="pcat-menu" data-menu-id="0">
                                <div class="pc-category-title font-weight-light">Категория</div>
                                <?php $__currentLoopData = $categories->getIndexCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($category_item->children->isEmpty()): ?>
                                        <div class="pc-category-item">
                                            <a href="<?php echo e(route('admin.product.create', ['category_id' => $category_item->id])); ?>"><?php echo e($category_item->name); ?></a>
                                        </div>
                                    <?php else: ?>
                                        <div class="pc-category-item pcat-next-menu" data-next-menu-id="<?php echo e($category_item->id); ?>" data-menu-id="0">
                                            <span><?php echo e($category_item->name); ?></span>
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__currentLoopData = $categories->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$category_item->children->isEmpty()): ?>
                                    <div class="pcat-menu" data-menu-id="<?php echo e($category_item->id); ?>" style="display: none">
                                        <div class="pc-category-title font-weight-light pcat-prev-menu" data-menu-id="<?php echo e($category_item->id); ?>" data-prev-menu-id="<?php echo e($category_item->parent ? $category_item->parent->id : 0); ?>">
                                            <i class="ti-angle-left"></i>
                                            <span><?php echo e($category_item->name); ?></span>
                                        </div>
                                        <?php $__currentLoopData = $category_item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($children->children->isEmpty()): ?>
                                                <div class="pc-category-item">
                                                    <a href="<?php echo e(route('admin.product.create', ['category_id' => $children->id])); ?>"><?php echo e($children->name); ?></a>
                                                </div>
                                            <?php else: ?>
                                                <div class="pc-category-item pcat-next-menu" data-menu-id="<?php echo e($category_item->id); ?>" data-next-menu-id="<?php echo e($children->id); ?>">
                                                    <span><?php echo e($children->name); ?></span>
                                                    <i class="ti-angle-right"></i>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <input class="form-control d-none" name="category_id" value="<?php echo e($category->id ?? false); ?>"
                               checked type="radio" required>
                        <div class="invalid-feedback font-weight-bold">Выберите категорию</div>
                        <?php if($errors->has('category_id')): ?>
                            <span class="font-weight-bold small"><?php echo e($errors->first('category_id')); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if(!is_null($category)): ?>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="inputName">Название</label>
                            </div>
                            <div class="col-lg-8">
                                <input name="name" value="<?php echo e(old('name')); ?>" type="text" class="form-control form-control-sm" id="inputName" required>
                            </div>
                            <div class="col">
                                <?php if($errors->has('name')): ?>
                                    <span class="font-weight-bold text-danger small"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="inputPrice">Цена</label>
                            </div>
                            <div class="col-lg-8">
                                <input name="price" value="<?php echo e(old('price')); ?>" type="text" class="form-control form-control-sm" id="inputPrice" required>
                            </div>
                            <div class="col">
                                <?php if($errors->has('price')): ?>
                                    <span class="font-weight-bold small"><?php echo e($errors->first('price')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="inputDescription">Описание</label>
                            </div>
                            <div class="col-lg-8">
                                <textarea name="description" class="form-control form-control-sm" id="inputDescription" required><?php echo e(old('description')); ?></textarea>
                            </div>
                            <div class="col">
                                <?php if($errors->has('description')): ?>
                                    <span class="font-weight-bold small"><?php echo e($errors->first('description')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-2">
                                <label>Фотографии</label>
                            </div>
                            <div id="dzImage" class="ml-2" data-img-limit="<?php echo e($image_limit); ?>">
                                <div class="small mb-1">основное фото</div>
                                <div class="dzImage-wrap">
                                    <div class="item item-add">
                                        <div class="uploader">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                        <div class="loader spinner-grow" role="status" style="display: none">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <input id="inputImagesBuffer" type="file" accept="image/*" multiple="true" hidden>
                                <input name="images" id="inputImages" type="text" hidden>
                                <small class="form-text text-muted">Пожалуйста, загрузите действительный файл изображения. Размер изображения не должен превышать 10 МБ.</small>
                                <span class="errors font-weight-bold text-danger small"></span>
                            </div>
                        </div>
                        <?php if($category->properties->isNotEmpty()): ?>
                            <hr>
                            <h5 class="mb-4 font-weight-normal">Параметры</h5>
                            <?php $__currentLoopData = $category->properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="property<?php echo e($property->id); ?>"><?php echo e($property->name); ?></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="properties[<?php echo e($property->slug); ?>]" class="custom-select custom-select-sm"
                                                                                id="property<?php echo e($property->id); ?>" required>
                                            <option selected disabled value="">Выберите значение</option>
                                            <?php $__currentLoopData = $property->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>" <?php echo e(old('properties.' . $property->slug) == $value->id ? 'selected' : ''); ?>><?php echo e($value->value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if($category->property_manuals->isNotEmpty()): ?>
                            <hr>
                            <h5 class="mb-4 font-weight-normal">Свойства</h5>
                            <?php $__currentLoopData = $category->property_manuals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group">
                                    <label for="propertyManual<?php echo e($property_manual->id); ?>"><?php echo e($property_manual->name); ?></label>
                                    <input name="property_manuals[<?php echo e($property_manual->id); ?>]" value="<?php echo e(old('property_manuals.' . $property_manual->id)); ?>" type="text" class="form-control form-control-sm" id="propertyManual<?php echo e($property_manual->id); ?>" required>
                                    <?php if($errors->has('property_manuals.' . $property_manual->id)): ?>
                                        <span class="font-weight-bold text-danger small"><?php echo e($errors->first('property_manuals.' . $property_manual->id)); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <div class="form-group mt-4">
                            <button class="btn btn-sm btn-primary shadow" type="submit">Добавить</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () {
            $('.pcat-next-menu').click(function (e) {
                let self = $(this);
                $(".pcat-menu[data-menu-id=" + self.data().menuId + "]").fadeOut(0),
                    $(".pcat-menu[data-menu-id=" + self.data().nextMenuId + "]").fadeIn();
            });

            $('.pcat-prev-menu').click(function (e) {
                let self = $(this);
                $(".pcat-menu[data-menu-id=" + self.data().menuId + "]").fadeOut(0);
                $(".pcat-menu[data-menu-id=" + self.data().prevMenuId + "]").fadeIn();
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/product/create.blade.php ENDPATH**/ ?>