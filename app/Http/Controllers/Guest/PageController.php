<?php

namespace App\Http\Controllers\Guest;

use App\Category;
use App\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class PageController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->limit(12)->get();

        return view('guest.index', compact('products'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);
        $mightAlsoLike = Product::where('id', '!=', $product->id)->inRandomOrder()->limit(4)->get();

        $has_category = $product->category;
        $array_breadcrumb = [];

        while (!is_null($has_category)) {
            array_push($array_breadcrumb, ['title'=>$has_category->name, 'href'=>$has_category->get_full_slug()]);
            $has_category = $has_category->parent;
        }

        $array_breadcrumb = array_reverse($array_breadcrumb);

        return view('guest.product', compact('product', 'mightAlsoLike', 'array_breadcrumb'));
    }

    public function feedbackCreate()
    {
        return view('guest.feedback');
    }

    public function feedbackStore(Request $request)
    {
        $validate_inputs = [
            'appeal' => 'required|max:60',
            'categoryAppeal' => 'required|max:60',
            'name' => 'required|max:60',
            'email' => 'required|email|max:255',
            'review' => 'required|max:600',
            'contactAgree' => 'required|accepted',
        ];

        if ( $request->phone !== null ) {
            $validate_inputs['phone'] = 'max:60';
        }

        $request->validate($validate_inputs);

        Feedback::create($request->except('contactAgree'));

        return redirect()->back()->with('success', 'Ваш отзыв был отправлен');
    }
}
