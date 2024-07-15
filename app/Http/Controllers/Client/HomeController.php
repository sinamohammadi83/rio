<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\CategoryResource;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();

        $newestProducts = Product::query()->limit(4)->get();

        return response()->json([
            'categories' => CategoryResource::collection($categories),
            'newestProducts' => $newestProducts
        ])->setStatusCode(200);
    }
}
