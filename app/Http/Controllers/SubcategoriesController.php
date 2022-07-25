<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Http\Requests\SubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Http\Resources\SubcategoriesResource;
use App\Traits\SlugTrait;

class SubcategoriesController extends Controller
{
    use SlugTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //This to display category data with each subcategory 
        // $subcategories = Subcategory::with(['category'])->get();
        // return SubcategoriesResource::collection($subcategories);
        //This without category data
        return SubcategoriesResource::collection(Subcategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubcategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request)
    {
        $subcategory = SubCategory::create(array_merge($request->validated(),[
            'subcategory_slug_en' => $this->makeSlug($request->subcategory_name_en),
            'subcategory_slug_ar' => $this->makeSlug($request->subcategory_name_ar),
        ]));
        return new SubcategoriesResource($subcategory); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        return new SubcategoriesResource($subcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SubcategoryRequest  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryRequest $request, Subcategory $subcategory)
    {
        $subcategory->update(array_merge($request->validated(),[
            'subcategory_slug_en' => $this->makeSlug($request->subcategory_name_en),
            'subcategory_slug_ar' => $this->makeSlug($request->subcategory_name_ar),
        ]));
        return new SubcategoriesResource($subcategory); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return response(null, 204);
    }
}
