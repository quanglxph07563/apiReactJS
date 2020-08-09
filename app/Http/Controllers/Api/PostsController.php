<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posts;
use App\Http\Requests\Posts\insertRequest;
use App\Http\Requests\Posts\updateRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Posts::orderBy('id','desc')->paginate(5);
        foreach ($data as $item) {
           $item->ten_danh_muc = $item->articleCategory->name_category;
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
        return Posts::create($insertRequest->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Posts::find($id);
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
        return Posts::find($id)->update($updateRequest->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Posts::find($id)->delete();

    }

    public function totalPosts()
    {
        return Posts::count('id');
    }

    public function getPostsDanhMuc($id)
    {
       if($id==0){
            return Posts::paginate(5);
       }else{
        return Posts::where('id_article_categories',$id)->paginate(5);
       }
    }
}
