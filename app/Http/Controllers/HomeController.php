<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

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
}
