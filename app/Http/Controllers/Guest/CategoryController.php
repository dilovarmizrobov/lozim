<?php

namespace App\Http\Controllers\Guest;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\FilterModel;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $slugs = explode('/', $slug);
        $parent_id = null;
        $category = null;
        $slug = '';
        $array_breadcrumb = [];

        for ($i = 0; $i < count($slugs); $i++) {
            $category = Category::where('parent_id', $parent_id)->where('slug', $slugs[$i])->first();

            if (!is_null($category)) $parent_id = $category->id;
            else abort(404);

            $slug .= $slugs[$i] . '/';
            array_push($array_breadcrumb, ['title'=>$category->name, 'href'=>$slug]);
        }

        $filter_model = (new FilterModel($category));
        $products = $filter_model->get_index();

        return view('guest.category', [
            'category'=>$category,
            'products'=>$products,
            'array_breadcrumb'=>$array_breadcrumb,
            'sort'=>request()->sort,
        ]);
    }
}
