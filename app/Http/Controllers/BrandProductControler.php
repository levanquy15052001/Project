<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller;


class BrandProductControler extends Controller
{
    public function add_brand()
    {
            return view('admin.brand.Add_brand');
    }

    public function all_brand()
    {
        $data = Brand::with('users')
                    ->where('del_flag',0)
                    ->get();
        return view('admin.brand.All_brand',compact('data'));
    }

    public function post_add_brand(Request $request)
    {
        $data = array();
        $data['brand_name']= $request->brand_name;
        $data['brand_desc']= $request->brand_desc;
        $data['brand_status']= $request->brand_status;
        $data['id_user_add']= Auth::user()->id;
        $data['created_at']= date('Y-m-d H:i:s');
        DB::table('tbl_brand_product')->insert($data);
        return Redirect::back()->with('msg','Add Brand Prooduct Successfully');
    }
    public function Custom($id,$custome)
    {
       if(DB::table('tbl_brand_product')->where('brand_id',$id) && $custome)
       {
        switch($custome) {
            case(1):
                DB::table('tbl_brand_product')->where('brand_id',$id)->update(['brand_status'=>2]);
                return Redirect::back();
                break;
            case(2):
                DB::table('tbl_brand_product')->where('brand_id',$id)->update(['brand_status'=>1]);
                return Redirect::back();
                break;
            case('sua'):
                $data =  DB::table('tbl_brand_product')->where('brand_id',$id)->first();
                return view('admin.brand.Update_brand',compact('data'));
                break;
            case('xoa'):
                DB::table('tbl_brand_product')->where('brand_id',$id)
                    ->update(['del_flag'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                DB::table('tbl_product')->where('brand_id',$id)
                    ->update(['del_flag'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                    return Redirect::back()->with('msg','Delete Brand Product Successfully');
                    break;
            default:
                return Redirect::back();
        }
       }
       else{
            return Redirect::back();
       }
    }

    public function update_brand_product(Request $request)
    {
        DB::table('tbl_brand_product')->where('brand_id',$request->id)
        ->update([
                    'brand_name'=>$request->brand_name,
                    'brand_desc'=>$request->brand_desc,
                    'brand_status'=>$request->brand_status,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
        return Redirect::route('admin.all_brand')->with('msg','Update Brand Product Successfully');
    }
    
}
