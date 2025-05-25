<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        //return response()->json(Product::with(['category', 'brand', 'tags', 'images'])->get());
        return response()->json(Product::all());

    }
}
