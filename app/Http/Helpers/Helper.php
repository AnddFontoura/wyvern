<?php

namespace App\Http\Helpers;

use App\Category;
use App\ProductImage;

class Helper 
{
    public static function getCategories()
    {
        return Category::get();
    }

    public static function getOneImageForProduct($productId) 
    {
        return ProductImage::where('product_id', $productId)->first();
    }
}
