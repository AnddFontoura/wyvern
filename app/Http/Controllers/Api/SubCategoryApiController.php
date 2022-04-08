<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Response;

class SubCategoryApiController extends Controller
{
    public function countSubCategories()
    {
        $countSubCategories = SubCategory::count('id');

        return response()->json(['countSubCategories' => $countSubCategories], Response::HTTP_OK);
    }
}
