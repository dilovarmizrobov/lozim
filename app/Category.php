<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }

    public function neighbors()
    {
        if (is_null($this->parent_id)) return $this->getIndexCategories();

        return $this->parent->children;
    }

    public function active($id)
    {
        return $this->id === $id;
    }

    public function get_full_slug()
    {
        $self = $this;
        $array_slug = [];
        $slug = '';

        while (!is_null($self)) {
            array_push($array_slug, $self->slug);
            $self = $self->parent;
        }

        $array_slug = array_reverse($array_slug);

        for ($i = 0; $i < count($array_slug); $i++) {
            $slug .= $array_slug[$i] . '/';
        }

        return $slug;
    }

    public function getIndexCategories()
    {
        return $this->where('parent_id', null)->get();
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
