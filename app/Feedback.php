<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * Relation Table
     *
     * @var array
     */
    protected $table = 'feedbacks';

    /**
     * Guarded columns
     *
     * @var array
     */
    protected $guarded = [];
}
