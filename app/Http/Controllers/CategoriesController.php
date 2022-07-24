<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoriesResource;
use App\Traits\SlugTrait;

class CategoriesController extends Controller
{
    use SlugTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoriesResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create(array_merge($request->validated(),[
            'category_slug_en' => $this->makeSlug($request->category_name_en),
            'category_slug_ar' => $this->makeSlug($request->category_name_ar),
        ]));
        return new CategoriesResource($category); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoriesResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update(array_merge($request->validated(),[
            'category_slug_en' => $this->makeSlug($request->category_name_en),
            'category_slug_ar' => $this->makeSlug($request->category_name_ar),
        ]));
        return new CategoriesResource($category); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response(null, 204);
    }
}
