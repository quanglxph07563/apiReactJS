<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ArticleCategory;
use App\Http\Requests\ArticleCategorys\createRequest;
use App\Http\Requests\ArticleCategorys\updateRequest;


class ArticleCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ArticleCategory::orderBy('id', 'desc')->paginate(5);
        foreach ($data as $value) {
            $value->slsp =$value->total_posts;
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $createRequest)
    {
        return ArticleCategory::create($createRequest->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ArticleCategory::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $updateRequest, $id)
    {
        return ArticleCategory::find($id)->update($updateRequest->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ArticleCategory::find($id)->delete();

    }

    public function getAllArticleCategory()
    {
        return ArticleCategory::all();
    }
}
