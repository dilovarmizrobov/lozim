<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    const PATH_IMAGES_PRODUCTS = 'images/products/';
    const PATH_IMAGES_UPLOADS = 'images/uploads/';
    const IMAGE_FORMAT = '.png';
    const DEFAULT_IMAGE = 1;
    const IMAGE_LIMIT = 4;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImagesDeletePathAttribute()
    {
        return [self::PATH_IMAGES_PRODUCTS . $this->image_medium, self::PATH_IMAGES_PRODUCTS
            . $this->image_small];
    }

    public function getImageMediumUrlAttribute()
    {
        return Storage::disk('public')->url(self::PATH_IMAGES_PRODUCTS . $this->image_medium);
    }

    public function getImageSmallUrlAttribute()
    {
        return Storage::disk('public')->url(self::PATH_IMAGES_PRODUCTS . $this->image_small);
    }

    public function getNameWithoutFormatAttribute()
    {
        return str_replace(self::createName('', config('image.size.medium')), '',
            $this->image_medium);
    }

    public static function createName($uniq_string, $size)
    {
        return $uniq_string . $size['width'] . 'x' . $size['height'] . self::IMAGE_FORMAT;
    }
}
