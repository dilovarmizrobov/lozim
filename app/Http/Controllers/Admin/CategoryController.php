<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = new Category;
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!$request->has('parent_id')) abort(404);

        $parent_id = $request->parent_id === 'null' ? null : $request->parent_id;

        if (!is_null($parent_id)) Category::findOrFail((int)$parent_id);

        $request->validate(['name'=>'required|max:255',]);

        $duplicate = Category::where('parent_id', $parent_id)->where('name', $request->name)->get();

        if (!$duplicate->isEmpty())
            return redirect()->back()->withInput()->with('success', 'Данная категория существует!');

        Category::create(['name' => $request->name, 'parent_id' => $parent_id, 'slug' => Str::slug($request->name)]);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate(['name' => 'required|max:255']);

        $duplicate = Category::where('parent_id', $category->parent_id)->where('name', $request->name)->get();

        if (!$duplicate->isEmpty()) return redirect()->back()->with('success', 'Данная категория существует!');

        $category->update(['name' => $request->name, 'slug' => Str::slug($request->name)]);

        return redirect()->route('admin.categories.index')->with('success', 'Категория была успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if (!$category->products->isEmpty()) {
            return redirect()->back()->with('error', 'В категории есть товар!');
        }

        $category->delete();

        return redirect(route('admin.categories.index'))->with('success', 'Категория была успешно удалена!');
    }
}
