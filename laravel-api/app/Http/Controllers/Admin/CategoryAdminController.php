<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;

class CategoryAdminController extends Controller
{
    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate(20);
        return view('admin.grocery.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.grocery.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->validated());
        return redirect('/admin/grocery/categories')->with('status', 'Category created');
    }

    public function edit(Category $category)
    {
        return view('admin.grocery.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect('/admin/grocery/categories/'.$category->id.'/edit')->with('status', 'Updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/admin/grocery/categories')->with('status', 'Deleted');
    }
}
