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

    public function getProducts(Request $request)
    {
        $this->validate($request, [
            'productsId' => 'required|array'
        ]);

        $productsId = $this->get('productsId');
        $products = Product::where('id', 'in', $productsId)
            ->get()
            ->toArray();

        return response()->json($products, Response::HTTP_OK);
    }
}
