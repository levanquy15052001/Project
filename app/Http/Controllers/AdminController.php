<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $sumProduct = Cart::all();
        $sumProduct = count($sumProduct);
        
        $dataProduct = Cart::join('tbl_shopping','tbl_shopping.id', '=','tbl_cart.shoping_id')
                ->join('tbl_product','tbl_product.product_id', '=','tbl_shopping.product_id')
                ->select(DB::raw('DISTINCT tbl_shopping.product_id as product_id, COUNT(*) AS count,tbl_product.product_name as product_name'))
                ->groupBy('tbl_shopping.product_id')
                ->orderBy('count', 'desc')
                ->get();
        foreach($dataProduct as $key =>$value)
            {
                $tile =  $value->count * 100 /$sumProduct  ;
                $dataProduct[$key]['tile'] = $tile;
                
            }
    
        $dataCategory = Category::select('category_id','category_name')->where('del_flag',0)->get();
        $sumDataCategory = count($dataCategory);

        $chartDataCategory =  Cart::join('tbl_shopping','tbl_shopping.id', '=','tbl_cart.shoping_id')
                                ->join('tbl_product','tbl_product.product_id', '=','tbl_shopping.product_id')
                                ->select(
                                        'tbl_product.product_id as product_id',
                                        'tbl_product.category_id as category_id'
                                        )
                                ->get();          
                      
            for($i =0 ; $i < count($dataCategory);  $i ++)
            {
                $dataCategory[$i]['sum'] = 0;
                for($j =0 ; $j < count($chartDataCategory);  $j ++)
                {
                    if( $dataCategory[$i]->category_id ==  $chartDataCategory[$j]->category_id)
                    {
                        $dataCategory[$i]->sum ++;
                    } 
                } 
            }
            foreach($dataCategory as $key => $items)
            {
                 $tile = $items->sum  * 100 /$sumDataCategory  ;
                 $dataCategory[$key]['tile'] = $tile;
                 
            }       
        return view('admin.Admin',compact(
                                        'sumProduct',
                                        'dataProduct', 
                                        'dataCategory'              
                                    ));
    }

    public function Login()
    {
        
        return view('admin.Auth.login');
    }

    public function Check_Login(Request $request)
    {      
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return Redirect::route('admin.index');
        }
        return Redirect::back()->withErrors(['msg' => 'Login Not Success']);
        
    }

    public function Logout()
    {
        $id = Auth::user()->admin_flag;
        Session::flush();
        Auth::logout();
        if($id==1)
        {

            return Redirect::route('admin.login');
        }
        else
        {
            return Redirect::route('index');
        }
    }

    public function Register()
    {     
        return view('admin.Auth.register');
    }

    public function CheckRegister(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confipassword' => 'required|same:password',
            'phone' => 'required|numeric',
        ]);
        $data = array();
        $data['name']= $request->name;
        $data['email']= $request->email;
        $data['password']=  bcrypt($request->password);
        $data['admin_flag']= 0;
        $data['created_at']= date('Y-m-d H:i:s');
        DB::table('users')->insert($data);
        return Redirect::back()->with('done','Register successfuly');
    }
}
