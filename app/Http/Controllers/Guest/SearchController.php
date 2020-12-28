<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $sorting_items = [
        ['priceup', 'up', 'price'],
        ['pricedown', 'down', 'price'],
        ['newly', 'down', 'id'],
    ];

    public function index(Request $request)
    {
        $searchText = $request->search;
        $sort = $request->sort;

        if (is_null($request->search)) {
            return redirect()->back();
        }

        $searchQueryProduct = $this->search(Product::query(), $request);
        $products = $this->sorting($searchQueryProduct, $request);
        $products = $products->paginate(12);

        return view('guest.search', compact('searchText', 'sort', 'products'));
    }

    private function search($queryProducts, $request)
    {
        $query = $request->search;

        return $queryProducts->where('name', 'like', "%$query%");
    }

    private function sorting($queryProducts, $request)
    {
        if (array_key_exists('sort', $request->all())) {
            foreach ($this->sorting_items as $item) {
                if ($request->sort === $item[0]) {
                    if ($item[1] === 'up') return $queryProducts->orderBy($item[2]);
                    elseif ($item[1] === 'down') return $queryProducts->orderByDesc($item[2]);
                }
            }
        }

        return $queryProducts;
    }
}
