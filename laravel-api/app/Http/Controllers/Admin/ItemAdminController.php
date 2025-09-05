<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\Admin\ItemStoreRequest;
use App\Http\Requests\Admin\ItemUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ItemAdminController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->orderByDesc('id')->paginate(20);
        return view('admin.grocery.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::orderBy('title')->get(['id','title']);
        return view('admin.grocery.items.create', compact('categories'));
    }

    public function store(ItemStoreRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/items');
            $data['image'] = basename($path);
        }
        Item::create($data);
        return redirect('/admin/grocery/items')->with('status', 'Item created');
    }

    public function edit(Item $item)
    {
        $categories = Category::orderBy('title')->get(['id','title']);
        return view('admin.grocery.items.edit', compact('item','categories'));
    }

    public function update(ItemUpdateRequest $request, Item $item)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/items');
            $data['image'] = basename($path);
        }
        $item->update($data);
        return redirect('/admin/grocery/items/'.$item->id.'/edit')->with('status', 'Updated');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect('/admin/grocery/items')->with('status', 'Deleted');
    }
}
