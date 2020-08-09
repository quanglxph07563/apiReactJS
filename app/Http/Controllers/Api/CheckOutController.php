<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Orders;
use App\Order_detail;

class CheckOutController extends Controller
{   
    public function thanhToan(Request $request)
    {
        $data = $request->all();
        $order_detail =json_decode($data['order_detail']);
        $slsp=0;
        foreach ($order_detail as $item) {
          $slsp+=$item->sl;
        }
        $data['total_product'] = $slsp;
        unset($data['order_detail']);

        $order = Orders::create($data);
        $id_order = $order->id;
        foreach ($order_detail as $item) {
            $item->id_order =$id_order;
            $item->amount =$item->sl;
            $item->id_product =$item->id;
            $arr=(array)$item;
            $order = Order_detail::create($arr);
        }
        return 'thành công';
    }

    public function donHang()
    {
       $data_order = Orders::where('status',0)->get();
       foreach ($data_order as $key => $value) {
         $value->name_user = $value->user->name;
         $value->phone = $value->user->phone;
         $value->email = $value->user->email;
         $value->detail = $value->orderDetail;
         foreach ($value->detail as $key => $item) {
            $item->name_product = $item->products->name_product;
            $item->images = $item->products->images;
            $item->price = $item->products->sale;
         }
       }
       return $data_order;
    }
    public function donHangDaPheDuyet()
    {
       $data_order = Orders::where('status',1)->get();
       foreach ($data_order as $key => $value) {
         $value->name_user = $value->user->name;
         $value->phone = $value->user->phone;
         $value->email = $value->user->email;
         $value->detail = $value->orderDetail;
         foreach ($value->detail as $key => $item) {
            $item->name_product = $item->products->name_product;
            $item->images = $item->products->images;
            $item->price = $item->products->sale;
         }
       }
       return $data_order;
    }

    public function changeStatusDonHang($id)
    {
       $data = Orders::find($id);
       $data->status = 1;
       $data->save();
       return 'thành công';
    }

    public function getTotalPrice()
    {
      return Orders::where('status',1)->sum('total_price');
    }

    public function sanPhamDaBan()
    {
      return Orders::where('status',1)->sum('total_product');
    }
}
