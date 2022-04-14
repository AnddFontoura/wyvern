<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $page_title =  "Dashboard";

        $products = Product::paginate(20);

        return view('welcome',compact('products', 'page_title'));
    }

    public function showCategoryProducts(int $categoryProducts): View
    {
        $page_title =  "Produto";

        $products = Product::paginate(20);

        return view('site.category.view',compact('products', 'page_title'));
    }

    public function showSubCategoryProducts(int $subCategoryId): View
    {
        $page_title =  "";

        $products = Product::where('sub_category_id', $subCategoryId)->paginate(20);

        return view('site.subcategory.view',compact('products', 'page_title'));
    }

    public function showProduct(int $productId): View
    {
        $page_title =  "";
        
        $product = Product::where('id', $productId)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();

        return view('site.product.view',compact('product', 'productImages', 'page_title'));
    }

    public function cart(): View
    {
        return view('site.cart.list');
    }
}
