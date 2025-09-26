<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Exceptions\BusinessException;

class GroceryController extends Controller
{
    public function categories()
    {
        try {
            $categories = Category::orderBy('title')->get();
            return $this->successResponse($categories);
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to fetch categories');
        }
    }

    public function categoryItems($id)
    {
        try {
            $category = Category::findOrFail($id);
            $items = Item::where('category_id', $category->id)->get();
            return $this->successResponse($items);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \App\Exceptions\NotFoundBusinessException('Category not found');
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to fetch category items');
        }
    }
}
