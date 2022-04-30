<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsNewOrderAttribute(): bool
    {
        return $this->status->id === 1;
    }

    public function getGeneralTotalAttribute()
    {
        return number_format($this->total + $this->delivery_price, 2);
    }

    public function getDeliveryTypeAttribute(): string
    {
        if ($this->delivery === 'express') {
            return 'Срочная доставка';
        }

        return 'Обычная доставка';
    }

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('H:i / d.m.y');
    }

    public function getDeliveryDateAttribute($value): string
    {
        return Carbon::parse($value)->format('H:i / d.m.Y');
    }
}
