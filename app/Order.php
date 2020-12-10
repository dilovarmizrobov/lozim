<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

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

    public function getDateAttribute()
    {
        return $this->created_at->format('d M Y');
    }
}
