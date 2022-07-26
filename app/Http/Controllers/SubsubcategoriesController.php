<?php

namespace App\Http\Controllers;

use App\Models\Subsubcategory;
use App\Http\Requests\SubsubcategoryRequest;
use App\Http\Resources\SubsubcategoriesResource;
use App\Traits\SlugTrait;
use Illuminate\Http\Request;

class SubsubcategoriesController extends Controller
{
    use SlugTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $include_arr = explode (",", $request->include); 
        $subsubcategories = Subsubcategory::when(in_array('category',$include_arr) , function ($query) {
            return $query->with(['category']);
        })->when(in_array('subcategory',$include_arr), function ($query) {
            return $query->with(['subcategory']);
        })->get();

        return SubsubcategoriesResource::collection($subsubcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubsubcategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubsubcategoryRequest $request)
    {
        $subsubcategory = SubsubCategory::create(array_merge($request->validated(),[
            'subsubcategory_slug_en' => $this->makeSlug($request->subsubcategory_name_en),
            'subsubcategory_slug_ar' => $this->makeSlug($request->subsubcategory_name_ar),
        ]));
        return new SubsubcategoriesResource($subsubcategory); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subsubcategory  $subsubcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subsubcategory $subsubcategory, Request $request)
    {
        $include_arr = explode (",", $request->include);
        in_array('category', $include_arr) ?
            $subsubcategory = $subsubcategory->load(['category']): // load means use the relationship method
            $subsubcategory;
        in_array('subcategory', $include_arr) ?
            $subsubcategory = $subsubcategory->load(['subcategory']): 
            $subsubcategory;
        return new SubsubcategoriesResource($subsubcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SubsubcategoryRequest  $request
     * @param  \App\Models\Subsubcategory  $subsubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubsubcategoryRequest $request, Subsubcategory $subsubcategory)
    {
        $subsubcategory->update(array_merge($request->validated(),[
            'subsubcategory_slug_en' => $this->makeSlug($request->subsubcategory_name_en),
            'subsubcategory_slug_ar' => $this->makeSlug($request->subsubcategory_name_ar),
        ]));
        return new SubsubcategoriesResource($subsubcategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subsubcategory  $subsubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsubcategory $subsubcategory)
    {
        $subsubcategory->delete();
        return response(null, 204);
    }
}
