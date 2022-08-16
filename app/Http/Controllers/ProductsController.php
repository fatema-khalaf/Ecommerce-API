<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subsubcategory;
use App\Models\Subcategory;
use App\Models\Product_image;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductsResource;
use App\Traits\SlugTrait;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;

class ProductsController extends Controller
{
    use SlugTrait;
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['images'])->get();
        return ProductsResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $subcategory_id = Subsubcategory::findOrFail($request->subsubcategory_id)->subcategory_id;
        $category_id = Subcategory::findOrFail($subcategory_id)->category_id;
        // Save product thambnail
        $thambnail = $request->file('product_thambnail');
         // save image in products folder
         $imageName = $this->saveImage($thambnail,'products');
         //remove image name from validated array
         $validatedValues = $request->validated(); 
         unset($validatedValues['product_thambnail']);

        $product = Product::create(array_merge($validatedValues,[
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'product_thambnail' => $imageName,
            'status' => 1,
            'product_slug_en' => $this->makeSlug($request->product_name_en),
            'product_slug_ar' => $this->makeSlug($request->product_name_ar),
        ]));

        // Save product images 
        $images = $request->file('images');
        foreach ($images as $image) {
            $imageName = $this->saveImage($image,'products');
            Product_image::create([
                'product_id' => $product->id,
                'image_name' => $imageName
            ]);
        };
        return new ProductsResource($product->load(['images'])); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductsResource($product->load(['images']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $subcategory_id = Subsubcategory::findOrFail($request->subsubcategory_id)->subcategory_id;
        $category_id = Subcategory::findOrFail($subcategory_id)->category_id;
        $product->update(array_merge($request->validated(),[
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'status' => $request->status ? $request->status : 1,
            'product_slug_en' => $this->makeSlug($request->product_name_en),
            'product_slug_ar' => $this->makeSlug($request->product_name_ar),
        ]));
        return new ProductsResource($product->load(['images'])); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response(null, 204);
    }
}
