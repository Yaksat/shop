<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Color $color)
    {
        return view('color.edit', compact('color'));
    }
}
