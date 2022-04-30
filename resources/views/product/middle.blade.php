<div class="card card-product-grid">
    <a href="{{ route('guest.product', $product->id) }}" class="img-wrap">
        <img src="{{ $product->image_medium }}" title="{{ $product->name }}">
    </a>
    <figcaption class="info-wrap">
        <div class="fix-height">
            <a href="{{ route('guest.product', $product->id) }}" class="title title-link" title="{{ $product->name }}">{{ $product->truncateName }}</a>
            <div class="price">{{ $product->price }} с.</div>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <div class="counter mr-3">
                <input id="counter{{ $product->id }}" type="text" value="{{ $product->quantityInCart }}" class="counter__field js-counter__number" maxlength="4">
                <div class="counter__arrow-block" role="group">
                    <span class="counter__arrow js-counter__plus" data-counter="#counter{{ $product->id }}"></span>
                    <span class="counter__arrow counter__arrow-down js-counter__minus" data-counter="#counter{{ $product->id }}"></span>
                </div>
            </div>
            <div class="mr-3">
                <button class="btn btn-sm btn-block {{ $product->available ? "btn-outline-primary" : "btn-outline-danger" }} js-product-tocart" {{ $product->available ? null : "disabled" }} data-url="{{ route('cart.add') }}" data-counter="#counter{{ $product->id }}" data-product-id="{{ $product->id }}">
                    @if($product->inCart)
                        <i class="fas la-sm fa-shopping-cart"></i>
                    @else
                        <i class="la la-lg la-shopping-cart"></i>
                    @endif
                </button>
            </div>
            <div>
                <button class="btn btn-sm btn-block btn-outline-primary js-product-tofavorite" data-url="{{ route('customer.favorite.toggle', $product->id) }}">
                    @if($product->isFavorite)
                        <i class="fas fa-heart"></i>
                    @else
                        <i class="far fa-heart"></i>
                    @endif
                </button>
            </div>
        </div>
    </figcaption>
</div>
