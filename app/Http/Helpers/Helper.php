<?php

namespace App\Http\Helpers;

use App\Category;

class Helper 
{
    public static function getCategories()
    {
        return Category::get();
    }
}
