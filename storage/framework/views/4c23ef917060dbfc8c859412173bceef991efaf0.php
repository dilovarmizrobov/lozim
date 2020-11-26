<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row my-4 align-items-center">
            <div class="col-auto">
                <h4 class="text-center font-weight-light">Редактировать продукт</h4>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('admin.product.index')); ?>" class="btn btn-sm btn-outline-primary">Назад</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <form class="formsValidate" action="<?php echo e(route('admin.product.update', $product->id)); ?>" method="post"  enctype="multipart/form-data" novalidate>
                    <?php echo e(method_field('PATCH')); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="form-group row">
                        <div class="col-auto">
                            <span class="fz-17">Категория <span class="font-weight-bold"><?php echo e($product->category->name); ?></span></span>
                        </div>



                    </div>



















































                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="inputName">Название</label>
                        </div>
                        <div class="col-lg-8">
                            <input name="name" value="<?php echo e(old('name') ? old('name') : $product->name); ?>" type="text" class="form-control form-control-sm" id="inputName" required>
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
                            <input name="price" value="<?php echo e(old('price') ? old('price') : $product->price); ?>" type="text" class="form-control form-control-sm" id="inputPrice" required>
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
                            <textarea name="description" class="form-control form-control-sm" id="inputDescription" required><?php echo e(old('description') ? old('description') : $product->description); ?></textarea>
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
                                <?php $__currentLoopData = $product->product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item item-preview" data-id="<?php echo e($image->nameWithoutFormat); ?>">
                                    <img src="<?php echo e($image->imageMediumUrl); ?>">
                                    <div class="item-delete small text-danger text-center" data-id="<?php echo e($image->nameWithoutFormat); ?>">удалить</div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="item item-add" style="<?php echo e($image_limit === 0 ? 'display: none;' : ''); ?>">
                                    <div class="uploader">
                                        <span class="ti-upload"></span>
                                    </div>
                                    <div class="loader spinner-grow" role="status" style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <input id="inputImagesBuffer" type="file" accept="image/*" multiple="true" hidden>
                            <input name="images" id="inputImages" type="text" value="<?php echo e($image_names); ?>" hidden>
                            <small class="form-text text-muted">Пожалуйста, загрузите действительный файл изображения. Размер изображения не должен превышать 10 МБ.</small>
                            <span class="errors font-weight-bold text-danger small"></span>
                        </div>
                    </div>
                    <?php if($product->category->properties->isNotEmpty()): ?>
                        <hr>
                        <h5 class="mb-4 font-weight-normal">Параметры</h5>
                        <?php $__currentLoopData = $product->category->properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="property<?php echo e($property->id); ?>"><?php echo e($property->name); ?></label>
                                </div>
                                <div class="col-lg-8">
                                    <select name="properties[<?php echo e($property->slug); ?>]" class="custom-select custom-select-sm"
                                            id="property<?php echo e($property->id); ?>" required>
                                        <option selected disabled value="">Выберите значение</option>
                                        <?php $__currentLoopData = $property->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>" <?php echo e(old('properties.' . $property->slug) ? (old('properties.' . $property->slug) == $value->id ? 'selected' : '') : (!is_null($product->properties->get($product->getPropertyName($property->id, $value->id))) ? 'selected' : '')); ?>><?php echo e($value->value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if($product->category->property_manuals->isNotEmpty()): ?>
                        <hr>
                        <h5 class="mb-4 font-weight-normal">Свойства</h5>
                        <?php $__currentLoopData = $product->category->property_manuals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label for="propertyManual<?php echo e($property_manual->id); ?>"><?php echo e($property_manual->name); ?></label>
                                <input name="property_manuals[<?php echo e($property_manual->id); ?>]" value="<?php echo e(old('property_manuals.' . $property_manual->id) ? old('property_manuals.' . $property_manual->id) : $product->property_manuals->get($property_manual->id - 1)->title); ?>" type="text" class="form-control form-control-sm" id="propertyManual<?php echo e($property_manual->id); ?>" required>
                                <?php if($errors->has('property_manuals.' . $property_manual->id)): ?>
                                    <span class="font-weight-bold text-danger small"><?php echo e($errors->first('property_manuals.' . $property_manual->id)); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <div class="form-group mt-4">
                        <button class="btn btn-sm btn-primary shadow" type="submit">Редактировать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>















<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Server\data\htdocs\app.loc\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>