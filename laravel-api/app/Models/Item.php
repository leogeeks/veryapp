<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['category_id', 'image', 'title', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
