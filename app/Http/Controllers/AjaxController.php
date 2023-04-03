<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function ajax_add_cart()
     {
        if(Auth::check() && Auth::user()->admin_flag == 0)
        {
          $pruduct = Product::where('product_id',$this->request->id)->first();
          $order = Order::where('product_id',$this->request->id)
                          ->where('customers_id',Auth::user()->id)
                          ->first();
          if($order == null)
          {
              $ordernew = new Order;
                
              $ordernew->product_id = $this->request->id;
              $ordernew->customers_id =Auth::user()->id;
              $ordernew->qty = 1;
              $ordernew->save();
               
              return response()->json(['success'=>'Đã Thêm Sản Phẩm ' .$pruduct->product_name . ' Vào Giỏ Hàng' ]);
          }
          else
          {
            $order->qty = $order->qty + 1;
            $order->save();
            return response()->json(['success'=>'Đã Cập Nhật ' .$pruduct->product_name . ' Vào Giỏ Hàng' ]);
          }
        }
        else
        {
          return response()->json(['errors'=>'Vui Long Dang Nhap']);
        }
         
     }
}
