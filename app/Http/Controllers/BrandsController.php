<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandsResource;
use App\Traits\SlugTrait;
use Image;

use Carbon\Carbon;

class BrandsController extends Controller
{
    use SlugTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BrandsResource::collection(Brand::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {               
        $request->validate([
            'brand_image' => 'required|image'
        ]);
        $image = $request->file('brand_image');
        $name_gen =
        hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        Image::make($image)->save('api/v1/upload/brands/' . $name_gen);

        $brand = Brand::create(array_merge($request->validated(),[
            'brand_image' => '/api/v1/upload/brands/' . $name_gen,
            'brand_slug_en' => $this->makeSlug($request->brand_name_en),
            'brand_slug_ar' => $this->makeSlug($request->brand_name_ar),
        ]));
        return new BrandsResource($brand);           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return new BrandsResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->update(array_merge($request->validated(),[
            'brand_slug_en' => $this->makeSlug($request->brand_name_en),
            'brand_slug_ar' => $this->makeSlug($request->brand_name_ar),
        ]));
        return new BrandsResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response(null, 204);
    }
}
