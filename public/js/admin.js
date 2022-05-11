$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    'use strict';
    let forms = $('.formsValidate');
    [].filter.call(forms, function(form) {
        $(form).submit(function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }

            $(form).addClass('was-validated');
        });
    });
});

$('.js-confirmAction').submit(e => {
    !confirm('Подтвердите действие!') && e.preventDefault();
});

$(function () {
    let orderStatus = $('.orderStatus');
    if (!orderStatus.length === true) return false;

    orderStatus.change(function () {
        let self = $(this);

        $.ajax({
            url: '/admin/order/' + self.data('id'),
            method: 'post',
            data: {
                status_id: self.val(),
                '_method': 'PATCH'
            },
            complete: function () {
                window.location.reload();
            }
        });
    });
});

$(function () {
    if (!document.getElementById('dzImage')) return;

    let dzImage = $('#dzImage'),
        itemAdd = $('#dzImage .item-add'),
        inputImagesBuffer = $('#dzImage #inputImagesBuffer'),
        inputImages = $('#dzImage #inputImages'),
        imagesIdArray = inputImages.val().length > 0 ? inputImages.val().split(',') : [],
        imagesLimit = dzImage.data().imgLimit,
        currentImagesCount = 0,
        uploadImages = null,
        currentUploadImage = 0,
        uploadImagesCount = 0,
        uploadingImage = false;

    itemAdd.on('click', () => {
        if (uploadingImage) return;
        inputImagesBuffer.click()
    });

    $('#dzImage .item-delete').on('click', itemDelete);

    inputImagesBuffer.on('change', function() {
        if (currentImagesCount === imagesLimit || uploadImagesCount > 0) return;

        uploadImages = this.files;
        uploadImagesCount = imagesLimit - currentImagesCount > uploadImages.length ? uploadImages.length : imagesLimit
            - currentImagesCount;
        currentImagesCount += uploadImagesCount;

        if (uploadImagesCount !== 0) {
            uploadImage();
            uploadingImage = true;
            $('#dzImage .uploader').hide();
            $('#dzImage .loader').show();
        }
    });

    Sortable.create($('#dzImage .dzImage-wrap')[0], {
        swapThreshold: 0.60,
        filter: '.item-add',
        animation: 150,
        onSort: () => {
            inputImages.val($('#dzImage .dzImage-wrap .item-preview').get()
                .map(function(elem) {return elem.dataset.id}));
        }
    });

    function uploadImage() {
        let formData = new FormData();
        formData.append('image', uploadImages[currentUploadImage]);

        $.ajax('/admin/product/upload-image', {
            complete: function() {
                currentUploadImage++;
                if (currentUploadImage < uploadImagesCount) uploadImage();
                else {
                    inputImagesBuffer.val("");
                    uploadImages = null;
                    currentUploadImage = 0;
                    uploadImagesCount = 0;
                    uploadingImage = false;
                    $('#dzImage .loader').hide();
                    $('#dzImage .uploader').show();

                    if (currentImagesCount === imagesLimit) itemAdd.hide();
                }
            },
            error: function(error) {
                let errorMsg = '';

                if (error.status === 422) errorMsg = error.responseJSON.errors.image.join(', ');
                else errorMsg = 'Произошла ошибка. попробуйте снова.';

                currentImagesCount--;
                $('#dzImage .errors').text(errorMsg);
            },
            success: function(data) {
                let preview = $('<div class="item item-preview" data-id="' + data.id + '">' +
                    '<img src="' + data.href + '">' +
                    '<div class="item-delete small text-danger text-center" data-id="' + data.id + '">удалить</div>' +
                    '</div>');

                itemAdd.before(preview);
                imagesIdArray.push(data.id);
                inputImages.val(imagesIdArray.join(','));

                $('#dzImage .item-delete[data-id="' + data.id + '"]').on('click', itemDelete);

                $('#dzImage .errors').text('');
            },
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
    }

    function itemDelete() {
        let id = $(this).data().id,
            index = imagesIdArray.indexOf(id);

        if (index > -1) imagesIdArray.splice(index, 1);

        inputImages.val(imagesIdArray.join(','));
        $('#dzImage .item-preview[data-id="' + id + '"]').remove();

        if (currentImagesCount === imagesLimit) itemAdd.fadeIn();

        currentImagesCount--;
    }
});
