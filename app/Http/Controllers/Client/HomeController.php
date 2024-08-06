<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\CategoryResource;
use App\Http\Resources\Client\UserResource;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

    }

    public function user()
    {
        return response()->json([
            'user' => new UserResource(auth()->user()),
            'code' => 2
        ])->setStatusCode(200);
    }
}
