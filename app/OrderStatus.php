<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['id'];

    public function getColorAttribute(): string
    {
        switch ($this->id) {
            case 1:
                $color = 'bg-light';
                break;
            case 2:
                $color = 'bg-success text-white';
                break;
            case 3:
                $color = 'bg-info text-white';
                break;
            case 4:
                $color = 'bg-primary text-white';
                break;
            case 5:
                $color = 'bg-danger text-white';
                break;
            default:
                $color = 'bg-light';
        }

        return $color;
    }
}
