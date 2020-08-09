<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Product\storeProduct;
use App\Http\Requests\Product\updateProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pardam = request()->all();
        // return $pardam['page_size']=='null';
        $query_pardam=[];
        $query_pardam['page_size'] = ($pardam['page_size']!='null')?$pardam['page_size']:4;
        $query_pardam['key'] = ($pardam['key']!='')?$pardam['key']:null;
        $query_pardam['iddm'] = ($pardam['iddm']!='null')?$pardam['iddm']:null;

        $queryBulder = Products::query(); 
        if (isset($query_pardam['iddm']) && $query_pardam['iddm'] != null) {
            $queryBulder->where('idCategory', '=', $query_pardam['iddm']);
        }
        if (isset($query_pardam['key']) && $query_pardam['key'] != null) {
            $queryBulder->where('name_product', 'like', '%'.$query_pardam['key'].'%');
        }
        $resurt = $queryBulder->orderBy('id', 'desc')->paginate($query_pardam['page_size']);
        foreach ($resurt as $value) {
            if($value->idCategory == 0){
                $value->tendm ='Chưa có danh mục';
            }
            else{
                if ($value->category==null) {
                    $value->tendm ='Chưa có danh mục';
                }else{
                    $value->tendm =$value->category->name_category;
                }
            }
        }    
        return $resurt;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeProduct $request)
    {
        $data = Products::create($request->all());
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
        return new ProductResource(Products::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateProduct $updateProduct, $id)
    {
        return Products::where('id', $id)->update($updateProduct->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return  Products::where('id', $id)->delete();
    }

    public function searchKeyProduct($key)
    {
        if($key == 'trong'){
            return Products::get();   
        }
        return Products::where('name_product', 'LIKE','%'.$key.'%')->get();
    }

    public function getProductClinet($id)
    {
        if($id>0)
        {
            return Products::where('idCategory',$id)->paginate(8);
        }
        else
        {
            return  Products::paginate(8);
        }
    }

    public function deleteMultipleProducts(Request $request)
    {
        $listId = $request->all();
        Products::whereIn('id', $listId)->delete();
        return 'Xóa thành công';
    }

    public function getProductPageCuaHang()
    { 

        $pardam =  request()->all();
        $query_pardam=[];
        $query_pardam['key'] = ($pardam['key']!='')?$pardam['key']:null;
        $query_pardam['sort'] = ($pardam['sort']!='')?$pardam['sort']:null;

        $queryBulder = Products::query(); 
        if (isset($query_pardam['key']) && $query_pardam['key'] != null) {
            $queryBulder->where('name_product', 'like', '%'.$query_pardam['key'].'%');
        }
        if (isset($query_pardam['sort']) && $query_pardam['sort'] != null) {
            switch ($query_pardam['sort']) {
                case 0:
                    $queryBulder->orderBy('name_product', 'ASC');
                    break;
                case 1:
                    $queryBulder->orderBy('name_product', 'DESC');
                    break;  
                case 2:
                    $queryBulder->orderBy('sale', 'ASC');
                    break;
                case 3:
                    $queryBulder->orderBy('sale', 'DESC');
                    break;             
                default:
                    # code...
                    break;
            }
         
        }
        $resurt = $queryBulder->paginate(12);
        return $resurt;
    }

    public function totalProduct()
    {
        return Products::sum('amount');
    }

    public function getSanPhamCungDanhMuc($id)
    {
        $id_dm = Products::find($id)->category->id;
        return Products::inRandomOrder()->where('idCategory',$id_dm)->where('id', '<>', $id)->get()->take(5);
    }
}