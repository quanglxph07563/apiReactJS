<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Category\insertRequest;
use App\Http\Requests\Category\updateCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::paginate(3);      
        foreach ($data as $value) {
            $value->slsp =$value->total_products;
        }
        return $data;
    }

    public function getAllCateGory()
    {
        $data = Category::all();      
        foreach ($data as $value) {
            $value->slsp =$value->total_products;
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(insertRequest $insertRequest)
    {
        $data = Category::create($insertRequest->all());
        return response()->json($data, 200);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CategoryResource(Category::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateCategory $updateCategory, $id)
    {
        unset($updateCategory['id_danhmuc']);

        return Category::where('id', $id)->update($updateCategory->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return  Category::find($id)->delete();
    }
}
