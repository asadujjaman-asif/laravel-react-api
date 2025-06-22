<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Helpers\ApiResponse;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $products = Product::with(
          [
            'category'=>function($query){
              $query->select('id','name','slug')
              ->where('status', '1');
            },
            'reviews'=>function($query){
                $query->select('id','product_id','rating','comment','reviewer_name','reviewer_email','reviewed_at');
            },
            'multi_image'=>function($query){
              $query->select('id','product_id','image_url')
              ->where('is_thumbnail', '0');
            }
        ])->paginate(100)
        ->appends(['limit' => 100]);

        $nextPage= $products->currentPage() < $products->lastPage() ? $products->currentPage() + 1 : null;
        return ApiResponse::success(
            data:$products->items(),
            message:"Get product list",
            statusCode:200,
            pagination:[
                'current_page'=>$products->currentPage(),
                'next_page'=>$nextPage,
                'next_page_url'  => $products->nextPageUrl(),
                'prev_page_url'  => $products->previousPageUrl(),
                'last_page'=>$products->lastPage(),
                'per_page'=>$products->perPage(),
                'total'=>$products->total(),
            ]
        );
    }
}
