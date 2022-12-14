<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Group;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class EditController extends BaseController
{
    public function __invoke(Product $product)
    {
        $categories = Category::all();
        $groups = Group::all();
        $tags = Tag::all();
        $colors = Color::all();
        return view('product.edit', compact('product', 'categories', 'tags', 'colors', 'groups'));
    }
}
