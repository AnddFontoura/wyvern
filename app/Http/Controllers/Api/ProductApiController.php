<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Response;

class ProductApiController extends Controller
{
    public function countProducts()
    {
        $countProducts = Product::count('id');

        return response()->json(['countProducts' => $countProducts], Response::HTTP_OK);
    }
}
