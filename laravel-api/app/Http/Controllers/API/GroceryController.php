<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class GroceryController extends Controller
{
    public function categories()
    {
        try {
            $categories = Category::orderBy('title')->get();
            return response()->json(['success' => true, 'data' => $categories]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Unable to fetch categories'], 500);
        }
    }

    public function categoryItems($id)
    {
        try {
            $category = Category::findOrFail($id);
            $items = Item::where('category_id', $category->id)->get();
            return response()->json(['success' => true, 'data' => $items]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }
    }
}
