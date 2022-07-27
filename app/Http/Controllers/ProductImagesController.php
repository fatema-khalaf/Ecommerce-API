<?php

namespace App\Http\Controllers;

use App\Models\Product_image;
use App\Models\Product;
use App\Http\Resources\ProductImagesResource;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return ProductImagesResource::collection($product->images()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $images = $request->images;
        foreach ($images as $image) {
            Product_image::create([
                'product_id' => $product->id,
                'image_name' => $image
            ]);
        };
        return ProductImagesResource::collection($product->images()->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Product_image $image) //without 👉 Product $product the method will cause error
    {
        return new ProductImagesResource($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Product_image $image)
    {
        $request->validate(['image_name' =>'required']);
        $image->update([
            'image_name' => $request->image_name,
        ]);
        return new ProductImagesResource($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Product_image $image)
    {
        $image->delete();
        return response(null, 204);
    }
}
