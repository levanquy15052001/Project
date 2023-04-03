<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller;

use Storage;


class ProductController extends Controller
{
    public function add_product()
    {
        $brand =DB::table('tbl_brand_product')
                    ->where('del_flag',0)
                    ->get();
        $categoty =DB::table('tbl_category_product')
                    ->where('del_flag',0)
                    ->get();

        return view('admin.product.Add_product',compact('brand','categoty'));
    }

    public function post_add_product(Request $request)
    {
            $rules =[
                'product_name'=>'required',
                'product_price'=>'required|numeric',
                'product_desc'=>'required',
                'product_content'=>'required',
                'product_category'=>'required',
                'product_brand'=>'required',
               
                'product_img' => 'required|mimes:jpg,jpeg,png,gif',
              ];
              $request->validate($rules);
            //Lưu hình ảnh vào thư mục Eshopper\images\product-details

            $product_img = $request->product_img;
            $getproduct_img = time().'_'.$product_img->getClientOriginalName();
            $destinationPath = public_path('Eshopper\images\product-details');
            $product_img->move($destinationPath, $getproduct_img);
            // Insert data 
            $data = array();
            $data['category_id']= $request->product_category;
            $data['product_name']= $request->product_name;
            $data['brand_id']= $request->product_brand;
            $data['product_desc']= $request->product_desc;
            $data['product_content']= $request->product_content;
            $data['product_price']= $request->product_price;
            $data['product_img']=$getproduct_img;
            $data['product_status']= $request->product_status;
            $data['created_at']= date('Y-m-d H:i:s');
            DB::table('tbl_product')->insert($data);
            // for($i=1;$i<=3;$i++)
            // {
            //  dd($request->product_img1);
            //   {
            //       dd('có');
            //   }
            // }
            // dd('ok');
            return Redirect::back()->with('msg','Add Prooduct Successfully');
    }

    public function all_product(Request $request)
    {

          $brand =DB::table('tbl_brand_product')
          ->where('del_flag',0)
          ->get();
          $categoty =DB::table('tbl_category_product')
                ->where('del_flag',0)
                ->get();

          if($request->brand_srearch && $request->category_srearch)
          {
            $data = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
            ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
            ->select('tbl_product.*','tbl_category_product.category_name','tbl_brand_product.brand_name')
            ->where('tbl_product.brand_id',$request->brand_srearch)
            ->where('tbl_product.category_id',$request->category_srearch)
            ->where('tbl_product.del_flag',0)
            ->paginate(5);
            return view('admin.product.All_product',compact('data','brand','categoty'));
          }
          elseif($request->brand_srearch || $request->category_srearch)
          {
            $data = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
            ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
            ->select('tbl_product.*','tbl_category_product.category_name','tbl_brand_product.brand_name')
            ->where('tbl_product.del_flag',0)
            ->where('tbl_product.brand_id',$request->brand_srearch)
            ->orWhere('tbl_product.category_id',$request->category_srearch)
            ->paginate(5);
            return view('admin.product.All_product',compact('data','brand','categoty'));
          }
          else
          {
            $data = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
            ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
            ->select('tbl_product.*','tbl_category_product.category_name','tbl_brand_product.brand_name')
            ->where('tbl_product.del_flag',0)
            ->paginate(5);
            return view('admin.product.All_product',compact('data','brand','categoty'));
          }
        
      
    }

    public function Custom($id,$custome)
    {
      if(DB::table('tbl_product')->where('product_id',$id) && $custome)
      {
       switch($custome) {
           case(1):
               DB::table('tbl_product')->where('product_id',$id)->update(['product_status'=>2]);
               return Redirect::back();
               break;
           case(2):
               DB::table('tbl_product')->where('product_id',$id)->update(['product_status'=>1]);
               return Redirect::back();
               break;
          case('sua'):
            $data = DB::table('tbl_product')
                    ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
                    ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
                    ->select('tbl_product.*','tbl_category_product.category_name','tbl_brand_product.brand_name')
                    ->where('product_id',$id)
                    ->where('tbl_product.del_flag',0)
                    ->first();

            $categoty = DB::table('tbl_category_product')
                      ->where('del_flag',0)
                      ->get();

            $brand = DB::table('tbl_brand_product')
                      ->where('del_flag',0)
                      ->get();

              return view('admin.product.Update_product',compact('data','categoty','brand'));
              break;
           case('xoa'):
               DB::table('tbl_product')->where('product_id',$id)
                  ->update(['del_flag'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                   return Redirect::back()->with('msg','Delete Product Successfully');
                   break;
           default:
               return Redirect::back();
       }
      }
      else{
           return Redirect::back();
      }
    }
    public function update_pruduct(Request $request)
    {
      $request->validate([
        'product_name'=>'required',
        'product_price'=>'required|numeric',
        'product_category'=>'required',
        'product_brand'=>'required',
        'product_status'=>'required',
        'product_img' => 'image|mimes:jpeg,png,jpg|max:2048',
        'datecreate' => 'required'
      ]);

      if($request->product_img)
      {
        $file_path_delete = "Eshopper/images/product-details/"."$request->img";
        if (file_exists($file_path_delete)) 
        {
           File::delete(public_path($file_path_delete));
        }
         //Lưu hình ảnh vào thư mục Eshopper\images\product-details
         $product_img = $request->product_img;
         $getproduct_img = time().'_'.$product_img->getClientOriginalName();
         $destinationPath = public_path('Eshopper\images\product-details');
         $product_img->move($destinationPath, $getproduct_img);
      }

      DB::table('tbl_product')->where('product_id',$request->id)
      ->update([
           'category_id'=>$request->product_category,
           'product_name'=>$request->product_name,
           'brand_id'=>$request->product_brand,
           'product_desc'=>$request->product_desc,
           'product_price'=>$request->product_price,
           'product_img'=>$getproduct_img??$request->img,
           'product_status'=>$request->product_status,
           'updated_at'=>date('Y-m-d H:i:s')
         ]);
       return Redirect::back()->with('msg','Update Product Successfully');
    }

}
