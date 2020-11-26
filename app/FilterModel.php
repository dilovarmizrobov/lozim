<?php


namespace App;

class FilterModel
{
    private $query = null;
    private $category = null;
    private $params = [];
    private $sorting_items = [
        ['priceup', 'up', 'price'],
        ['pricedown', 'down', 'price'],
        ['newly', 'down', 'id'],
    ];

    public function __construct($category)
    {
        $this->category = $category;
        $this->params = request()->all();
        $this->query = Product::query();
        $this->categories();
    }

    public function get_index()
    {
        $this->sorting();
        return $this->query->paginate(12);
    }

    private function has_param($param)
    {
        return array_key_exists($param, $this->params);
    }

    private function categories()
    {
        $categories = [];

        function get_id($category, &$categories) {
            array_push($categories, $category->id);

            foreach ($category->children as $child) get_id($child, $categories);
        }

        get_id($this->category, $categories);

        $this->query->whereIn('category_id', $categories);
    }

    private function sorting()
    {
        if ($this->has_param('sort')) {
            foreach ($this->sorting_items as $item) {
                if ($this->params['sort'] === $item[0]) {
                    if ($item[1] === 'up') $this->query->orderBy($item[2]);
                    elseif ($item[1] === 'down') $this->query->orderByDesc($item[2]);
                }
            }
        }
    }
}
