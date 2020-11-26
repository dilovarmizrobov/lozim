<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Guarded columns
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user from customer
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
