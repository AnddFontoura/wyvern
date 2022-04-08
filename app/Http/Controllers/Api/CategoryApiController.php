<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryApiController extends Controller
{
    public function countCategories()
    {
        $countCategories = Category::count('id');

        return response()->json(['countCategories' => $countCategories], Response::HTTP_OK);
    }
}
