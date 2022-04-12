<?php

namespace App\Http\Controllers;

use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $productId)
    {
        $this->validate($request, [
            'productImage' => 'required', //mimes:jpg,jpeg,png,JPEG,JPG,PNG
            'name' => 'nullable|string|min:1|max:250',
            'description' => 'nullable|string|min:1|max:250'
        ]);

        $productImageName = $request->post('name') ?? '';
        $productImageDescription = $request->post('description') ?? '';

        if ($request->file('productImage')) {
            $fileDir = 'product-image';

            $request->file('productImage')->store('public/' . $fileDir);
            $fileName = $fileDir . '/' . $request->file('productImage')->hashName();

            $product = ProductImage::create([
                'product_id' => $productId,
                'path' => $fileName,
                'name' => $productImageName,
                'description' => $productImageDescription,
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $productImageId = $request->post('id');
        $productImage = ProductImage::where('id', $productImageId)->delete();

        return response()->json(['message' => __('product_image.messages.deleted_with_success')], Response::HTTP_OK);
    }
}
