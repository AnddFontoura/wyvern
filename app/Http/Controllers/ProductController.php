<?php

namespace App\Http\Controllers;

use App\Product;
use App\SubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->all();

        $products = Product::select();

        if ($request['withDeleted'] == 'on') {
            $products = $products->withTrashed();
        }

        if ($request['categoryId']) {
            $products = $products->where('id', $request['categoryId']);
        }

        if ($request['subCategoryId']) {
            $products = $products->where('id', $request['subCategoryId']);
        }

        if ($request['subCategoryName']) {
            $products = $products->where('name', 'like', '%' . $request['subCategoryName'] . '%');
        }

        if ($request['orderByFieldName']) {
            $products = $products->orderBy($request['orderByFieldName'], $request['orderByMethod']);
        }

        $products = $products->paginate(20);

        $subcategories = SubCategory::withTrashed()->orderBy('name', 'asc')->get();

        return view('admin.product.index', compact('subcategories','products'));
    }

    public function create(int $id = null)
    {
        $product = null;

        if ($id) {
            $product = Product::where('id', $id)->first();
        }

        $subcategories = SubCategory::withTrashed()->orderBy('name', 'asc')->get();

        return view('admin.product.form', compact('subcategories', 'product'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sub_category_id' => 'required|integer|min:1',
            'name' => 'required|string|min:1|max:1000',
            'nickname' => 'nullable|string|min:1|max:1000',
            'description' => 'nullable|string|min:1|max:10000',
            'isbn' => 'nullable|string|min:1|max:100',
            'codebar' => 'nullable|string|min:1|max:100',
            'weight' => 'nullable|integer',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'depth' => 'nullable|integer',
            'price'  => 'nullable|integer',
        ]);

        $request = $request->only([
            'sub_category_id',
            'name',
            'nickname',
            'description',
            'isbn',
            'codebar',
            'weight',
            'width',
            'height',
            'depth',
            'price',
        ]);

        $product = Product::create($request);

        return redirect('admin/product')->with('message', __('product.messages.created_with_success'));
    }

    public function show(int $productId)
    {
        $product = null;

        if ($productId) {
            $product =  Product::where('id', $productId)->first();
        }

        return view('admin.subcategory.view', compact('product'));
    }

    public function update(Request $request, int $productId)
    {
        $this->validate($request, [
            'sub_category_id' => 'required|integer|min:1',
            'name' => 'required|string|min:1|max:1000',
            'nickname' => 'nullable|string|min:1|max:1000',
            'description' => 'nullable|string|min:1|max:10000',
            'isbn' => 'nullable|string|min:1|max:100',
            'codebar' => 'nullable|string|min:1|max:100',
            'weight' => 'nullable|float:12,3',
            'width' => 'nullable|float:12,2',
            'height' => 'nullable|float:12,2',
            'depth' => 'nullable|float:12,2',
            'price'  => 'nullable|float:12,2',
        ]);

        $request = $request->only([
            'sub_category_id',
            'name',
            'nickname',
            'description',
            'isbn',
            'codebar',
            'weight',
            'width',
            'height',
            'depth',
            'price',
        ]);

        Product::where('id', $productId)->update($request);

        return redirect('admin/product')->with('message', __('product.created_with_success'));
    }

    public function destroy(Request $request): JsonResponse
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $productId = $request->post('id');
        Product::where('id', $productId)->delete();

        return response()->json(__('product.deleted_with_success'), Response::HTTP_OK);
    }
}
