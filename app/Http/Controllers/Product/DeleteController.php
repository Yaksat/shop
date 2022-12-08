<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    public function __invoke(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }
}
