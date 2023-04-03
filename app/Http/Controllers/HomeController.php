<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Request $request)
    {
       
        switch($request->custome)
        {
            case('brand'):
                $Product = Product::where('del_flag',0)
                ->where('brand_id',$request->id)
                ->paginate(3);
                break;
            case('category'):
                $Product = Product::where('del_flag',0)
                ->where('category_id',$request->id)
                ->paginate(3);
                break;
            default:
                $Product = Product::where('del_flag',0)->paginate(12);
        }
        return view('page.trang_chu',compact('Product'));
    }

    public function show_detail(Request $request)
    {
        $Product = Product::where('tbl_product.del_flag',0)
                            ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
                            ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
                           // ->select('tbl_product.*','tbl_category_product.category_name','tbl_brand_product.brand_name')
                            ->where('tbl_product.product_id',$request->id)
                            ->first();
        $related = Product::where('tbl_product.del_flag',0)
                        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
                        ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
                        ->select('tbl_product.*','tbl_category_product.category_name','tbl_brand_product.brand_name')
                        ->where('tbl_product.category_id',$Product->category_id)
                        ->whereNotIn('tbl_product.product_id',[$Product->product_id])
                        ->paginate(3);
        return  view('page.show_details',compact('Product','related'));
    }

    public function pdf_user()
    {
        $user = Auth::user();

        $data = Cart::join('tbl_shopping','tbl_shopping.id', '=','tbl_cart.shoping_id')
                    ->join('tbl_product','tbl_product.product_id', '=', 'tbl_shopping.product_id')
                    ->join('tbl_information', 'tbl_information.id', '=', 'tbl_shopping.id_information')
                    ->where('tbl_shopping.customer_id',$user->id)
                    ->select('tbl_cart.price as tbl_cart_price',
                            'tbl_shopping.qty','tbl_shopping.id_information',
                            'tbl_product.product_name','tbl_product.product_img',
                             'tbl_information.address as information_address',
                             'tbl_information.phone as phone',
                             'tbl_information.note as note',
                             
                            )
                    ->get();
      
        $sumPrice = 0 ;
            for($i = 0;  $i<count($data); $i ++ )
            {
                $sumPrice += $data[$i]['tbl_cart_price'];
            }

        $pdf = PDF::loadView('pdf', compact('data','sumPrice','user'));
        //Nếu muốn hiển thị file pdf theo chiều ngang
        // $pdf->setPaper('A4', 'landscape');
        
        //Nếu muốn download file pdf
       return $pdf->download('myPDF.pdf');
        
        //Nếu muốn preview in pdf
        //return $pdf->stream('pdf',[$data,$sumPrice,$user]);
    }

    public function send_mail()
    {
        $to_name = "LeBaoQuy";
        $to_email = ["ng.khang389@gmail.com","levanquy"];//send to this email

        $data = array("name"=>"noi dung ten","body"=>"noi dung body"); //body of mail.blade.php
    
        Mail::send('send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        //--send mail
        return Redirect::back();

    }

}
