<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CategoryResource(true, 'List Data Category', Category::all());
    }

    /**
     * store
     */
    public function store(StoreCategoryRequest $request)
    {
        // Create new Category instance with validated data
        $category = Category::create($request->validated());

        // Return response with CategoryResource
        return new CategoryResource(true, 'Data Category Created', $category);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            // find category by id
            $categoryData = Category::findOrFail($id);

            // return response true
            return new CategoryResource(true, 'Category Details', $categoryData);
        } catch (\Exception $e) {
            // response error
            return new CategoryResource(false, 'Category not found', $e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Validate data
        $validatedData = $request->validated();
        $category->update($validatedData);

        // Return response
        return new CategoryResource(true, 'Category Updated Successfully', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            // delete category
            Category::findOrFail($id)->delete();

            // return response
            return new CategoryResource(true, 'Category Deleted Successfully', null);
        } catch(\Exception $e) {
            // response error
            return new CategoryResource(false, 'Category not found', $e);
        }
    }
}
