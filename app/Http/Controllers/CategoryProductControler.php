<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
class CategoryProductControler extends Controller
{
    public function All()
    {
        $data = Category::with('users')
                ->where('del_flag',0)
                ->get();
        return view('admin.All_Category',compact('data'));
    }

    public function Add()
    {
        return view('admin.Add_Category');
    }

    public function add_category_product(Request $request)
    {
        $data = array();
        $data['category_name']= $request->category_name;
        $data['category_desc']= $request->category_desc;
        $data['category_status']= $request->category_status;
        $data['id_user_add']=Auth::user()->id;
      //  $data['id_user_add']= Session::get('admin_id');
        $data['created_at']= date('Y-m-d H:i:s');
        DB::table('tbl_category_product')->insert($data);
        return Redirect::back()->with('msg','Add Category Prooduct Successfully');

    }

    public function Custom($id,$custome)
    {
       if(DB::table('tbl_category_product')->where('category_id',$id) && $custome)
       {
        switch($custome) 
        {
            case(1):
                DB::table('tbl_category_product')->where('category_id',$id)->update(['category_status'=>2]);
                return Redirect::back();
                break;
            case(2):
                DB::table('tbl_category_product')->where('category_id',$id)->update(['category_status'=>1]);
                return Redirect::back();
                break;
            case('sua'):
                $data =  DB::table('tbl_category_product')->where('category_id',$id)->first();
              //  dd($data);
                return view('admin.Update_Category',compact('data'));
                break;
            case('xoa'):
                DB::table('tbl_category_product')->where('category_id',$id)
                    ->update(['del_flag'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                DB::table('tbl_product')->where('category_id',$id)
                    ->update(['del_flag'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                    return Redirect::back()->with('msg','Delete Category Prooduct Successfully');
                    break;
            default:
                return Redirect::back();
        }
       }
       else{
            return Redirect::back();
       }
    }

    public function update_category(Request $request)
    {
        DB::table('tbl_category_product')->where('category_id',$request->id)
            ->update([
                        'category_name'=>$request->category_name,
                        'category_desc'=>$request->category_desc,
                        'category_status'=>$request->category_status,
                        'id_user_add'=>Auth::user()->id,
                        'updated_at'=>date('Y-m-d H:i:s'),
                    ]);
            return Redirect::route('admin.all_category')->with('msg','Update Category Prooduct Successfully');
    }
}
