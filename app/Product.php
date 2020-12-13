<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;
use Auth;
use Gate;
use Cart;

class Product extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Property')->withPivot('value');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('position');;
    }

    public function attribute_filter_values()
    {
        return $this->belongsToMany('App\AttributeFilterValue');
    }

    public static function getPropertyName($property_id, $property_value_id) {
        return 'p' . $property_id . 'v' . $property_value_id;
    }

    // Mutators
    public function getAvailableAttribute($value)
    {
        return $value === 'on' ? true : false;
    }

    public function getQuantityInCartAttribute() {
        $productId = $this->id;
        $duplicates = Cart::search(function ($cartItem) use ($productId) {
            return $cartItem->id === $productId;
        });

        if ($duplicates->isNotEmpty()) {
            return $duplicates->first()->qty;
        } else return 1;
    }

    public function getIsFavoriteAttribute()
    {
        if (Auth::check() && Gate::allows('is_customer')) {
            return Auth::user()->favorites()->where('product_id', $this->id)->exists();
        }

        return false;
    }

    public function getTruncateNameAttribute()
    {
        return Str::limit($this->name, 39);
    }

    public function getImageMediumAttribute()
    {
        if ($this->product_images->isEmpty()) return ProductImage::DEFAULT_IMAGE;
        else return $this->product_images->first()->imageMediumUrl;
    }

    public function getImageSmallAttribute()
    {
        if ($this->product_images->isEmpty()) return ProductImage::DEFAULT_IMAGE;
        else return $this->product_images->first()->imageSmallUrl;
    }

    public function getPropertiesAttribute($value)
    {
        return collect(json_decode($value));
    }

    public function getPropertyManualsAttribute($value)
    {
        return collect(json_decode($value));
    }
}
