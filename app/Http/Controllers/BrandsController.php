<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandsResource;
use App\Traits\SlugTrait;
use App\Traits\ImageTrait;

use Carbon\Carbon;

class BrandsController extends Controller
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
        // get image from request    
        $image = $request->file('brand_image');
        // save image in brands folder
        $imageName = $this->saveImage($image,'brands');
        //remove image name from validated array
        $validatedValues = $request->validated(); 
        unset($validatedValues['brand_image']);

        $brand = Brand::create(array_merge($validatedValues,[
            'brand_image' => $imageName,
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
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        if($request->file('brand_image')){
            $oldImage = $brand->brand_image;
            // get image from request    
            $newImage = $request->file('brand_image');
            // save image in brands folder
            $imageName = $this->updateImage($oldImage ,$newImage,'brands');
            $brand->update(array_merge($request->validated(),[
                'brand_image' => $imageName,
                'brand_slug_en' => $this->makeSlug($request->brand_name_en),
                'brand_slug_ar' => $this->makeSlug($request->brand_name_ar),
            ]));
        }
        if(!$request->file('brand_image')){
            $brand->update(array_merge($request->validated(),[
                'brand_slug_en' => $this->makeSlug($request->brand_name_en),
                'brand_slug_ar' => $this->makeSlug($request->brand_name_ar),
            ]));
        }
        

       
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
