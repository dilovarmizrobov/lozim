var App = {
    loaderBar: function(b) {
        var loader = $("#page_loader"),
            bar = loader.children().first();
        if (b) {
            bar.css("width", "0");
            loader.css(App.prefix.js + 'Transform', 'translateX(0)');
        } else {
            bar.css("width", "100%");
            setTimeout(function() {
                loader.css(App.prefix.js + 'Transform', '');
            }, 500);
        }
    },
    loaderAnimationAjax: function() {
        var xhr = $.ajaxSettings.xhr(),
            bar = $("#page_loader").children().first();

        xhr.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                bar.css("width", percentComplete*100 + "%");
            }
        }, false);

        return xhr;
    },
    prefix: function() {
        var styles = window.getComputedStyle(document.documentElement, ''),
            pre = (Array.prototype.slice
                    .call(styles)
                    .join('')
                    .match(/-(moz|webkit|ms)-/) || (styles.OLink === '' && ['', 'o'])
            )[1],
            dom = ('WebKit|Moz|MS|O').match(new RegExp('(' + pre + ')', 'i'))[1];
        return {
            dom: dom,
            lowercase: pre,
            css: '-' + pre + '-',
            js: pre[0].toUpperCase() + pre.substr(1)
        };
    }()
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function() {
        App.loaderBar(true);
    },
    complete: function() {
        App.loaderBar(false);
    }
});

// Catalog Menu
$(function () {
    'use strict';
    $('.js-toggleCatalogMenu').click(() => $('.js-catalogMenu').toggleClass('open'));

    if (location.pathname === '/') $('.js-catalogMenu').addClass('open');
});

// Settings
$(function () {
    'use strict';
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
});

//Form Validation
$(function() {
    'use strict';
    let forms = $('.formValidate');
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

$(function () {
    // js-counter__number

    $('.js-counter__number').on('input', function () {
        this.value = parseInt(this.value) || 1;
    });

    $('.js-counter__plus').click(function() {
        let counter = $(this.dataset.counter),
            counterValue = parseInt(counter.val());

        if (counterValue < 9999) counter.val(++counterValue);
    });

    $('.js-counter__minus').click(function() {
        let counter = $(this.dataset.counter),
            counterValue = parseInt(counter.val());

        if (counterValue > 1) counter.val(--counterValue);
    });

    $('.js-product-tocart').click(function () {
        var self = this;
        $.ajax({
            type: "POST",
            url: this.dataset.url,
            dataType: 'json',
            data: {
                product_id: this.dataset.productId,
                product_count: $(this.dataset.counter).val()
            },
            success: function (data) {
                $(".header_count_products").text(data.count_products);
                $(".header_total_price").text(data.total_price);
                self.firstElementChild.classList.add("fas", "la-sm", "fa-shopping-cart")
                self.firstElementChild.classList.remove("la", "la-lg", "la-shopping-cart")
            },
            xhr: App.loaderAnimationAjax,
        });
    });

    $('.js-product-edit-count-in-cart').click(function () {
        let productCount = parseFloat($(this.dataset.counter).val()),
            subtotalHref = $(this.dataset.subtotalHref),
            productPrice = parseFloat(this.dataset.price);

        $.ajax({
            type: "POST",
            url: this.dataset.url,
            dataType: 'json',
            data: {
                product_id: this.dataset.productId,
                product_count: productCount
            },
            success: function (data) {
                $(".header_count_products").text(data.count_products);
                $(".header_total_price").text(data.total_price);
                subtotalHref.text(productCount * productPrice);

                if (data.hasFreeShipping) {
                    $('.freeShipping').removeClass('d-none');
                    $('.paidShipping').addClass('d-none');
                } else {
                    $('.freeShipping').addClass('d-none');
                    $('.paidShipping').removeClass('d-none');
                }
            },
            xhr: App.loaderAnimationAjax,
        });
    });

    $('input[name="checkoutDelivery"]').change(function (e) {
        if ($(this).val() === 'regular') {
            $('.regularDeliveryPrice').removeClass('d-none');
            $('.expressDeliveryPrice').addClass('d-none');
        } else if ($(this).val() === 'express') {
            $('.regularDeliveryPrice').addClass('d-none');
            $('.expressDeliveryPrice').removeClass('d-none');
        }

        let total = (+ $('input[name="checkoutTotal"]').val() + $(this).data().price).toFixed(2);
        $('.checkoutTotal').text(total);
    });

    $('.js-product-tofavorite').click(function () {
        $.post(this.dataset.url, () => {
            $(this.firstElementChild).toggleClass('far fas')
        }).fail(() => {
            alert("Войдите в систему для добавление товаров в избранное!")
        })
    });
});
