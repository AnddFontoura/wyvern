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

        $productsId = $request->get('productsId');
        $products = Product::whereIn('id', $productsId)
            ->get()
            ->toArray();
        
        for($i = 0; $i < count($products); $i++) {
            $products[$i]['price_formatted'] = number_format($products[$i]['price'], 2, __('basic.numerals.decimal_separator'), __('basic.numerals.thousand_separator'));
        }

        return response()->json($products, Response::HTTP_OK);
    }
}
