<?php

namespace App\Http\Controllers;
use App\Models\{
    Category,
    Information,
    Product,
    Shoping,
    Cart,
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Cart as ShoppingcartCart;
use Illuminate\Routing\Controller;
use App\Repositories\Inforation\InforationRepository;
use App\Repositories\Customer\CustomerRepository;

class CartController extends Controller
{
    
   /**
     * @var CustomerController
     */
    protected $repository;

    public function __construct(InforationRepository $Infomationrepository, CustomerRepository $Userrepository)
    {
        $this->Infomationrepository = $Infomationrepository;
        $this->Customerrepository = $Userrepository;

    }

    public function show_cart(Request $request)
    {
        $sum = 0;
        if(Auth::check() && Auth::user()->admin_flag==0)
        {
            $cart_item =  ShoppingcartCart::content();
            $Customer = $this->Customerrepository->with('user_has_information')->find(Auth::user()->id);
            return view('page.cart.cart',compact('cart_item','sum','Customer'));
        }
        else
        {
            return Redirect::back()->withErrors(['msg' => 'Vui Long Dang Nhap!']);
        }
        
    }

    public function add_cart(Request $request)
    {
       if(Auth::check() && Auth::user()->admin_flag==0)
       {   
            $data = array();
            $data['id']= $request->id;
            $data['qty']= $request->qty;
            $product_info= Product::where('product_id',$data['id'])->first();
            $data['name']=  $product_info->product_name;
            $data['price']=$product_info->product_price;
            $data['weight']= 550;
            $data['options']['image']= $product_info->product_img;
            ShoppingcartCart::add($data);
            ShoppingcartCart::setGlobalTax(0);
            // ShoppingcartCart::destroy();
            return Redirect::route('show_cart');
       }
       else
       {
        return Redirect::back()->withErrors(['msg' => 'Vui Long Dang Nhap!']);
       }
    }

    public function updatecart(Request $request)
    {
       if($request->id)
       {
        switch ($request->custome) {
            case 'xoa':
                $rowId = $request->id;
                ShoppingcartCart::remove($rowId);
                return Redirect::back();
                break;
            case 'update_qty':
                $rowId = $request->id;
                $qty = $request->cart_quantity;
                ShoppingcartCart::update($rowId, $qty);
                return Redirect::back();
                break;
        }
       }
       else
       {
        return Redirect::back();
       }
    }
    public function check_out(Request $request)
    {
        $cart_item =  ShoppingcartCart::content();
        $Customer = $this->Customerrepository->with('user_has_information')->find(Auth::user()->id);
        if(count($cart_item)!=0)
        {
            $information = Information::find(Auth::user()->id);
            return view('page.cart.cart',compact('information','cart_item','Customer'));
        }
        else
        {
          
            return Redirect::back()->with(['warning' => 'Giỏ Hàng Chưa Có Sản Phẩm']);
        }
     
    }

    public function save_check_out(Request $request)
    {
        if($request->has('address')){

            return redirect()->route('inforOrderNew');

        }
       
        elseif($request->has('id_address')==null)
        {
            $rules =[
                'email'=>'required|email',
                'name'=>'required',
                'phone'=>'required|numeric',
                'address'=>'required',
                'city'=>'required',
                'district'=>'required',
                'ward'=>'required',
              ];
            
            $request->validate($rules);
            $information = new Information();
             $information->customer_id = Auth::user()->id;
             $information->name = $request->name ;
             $information->email = $request->email;
             $information->phone = $request->phone;
             $information->address = $request->address.' '. $request->ward .' '. $request->district .' '. $request->city ;
             $information->note = $request->note ?? '';
             $information->save();
        }

        if(ShoppingcartCart::subtotal()!=0)
        {
           
            if($request->id_address==null)
            {
                $rules =[
                    'email'=>'required|email',
                    'name'=>'required',
                    'phone'=>'required|numeric',
                    'address'=>'required',
                    'city'=>'required',
                    'district'=>'required',
                    'ward'=>'required',
                  ];
                $request->validate($rules);
                
                $information = new Information();
                 $information->customer_id = Auth::user()->id;
                 $information->name = $request->name ;
                 $information->email = $request->email;
                 $information->phone = $request->phone;
                 $information->address = $request->address .' '. $request->ward .' '. $request->district .' '. $request->city ;
                 $information->note = $request->note ?? '';
                 $information->save();
            }
    
                $Shoping = new Shoping ();
                $cart_item =  ShoppingcartCart::content();
                foreach($cart_item as $value)
                {
                    $Shoping->product_id = $value->id;
                    $Shoping->customer_id = Auth::user()->id;
                    $Shoping->qty = $value->qty;
                    $Shoping->id_information = $request->id_address?? $information->id;
                    $Shoping->status = 1;
                    $Shoping->save();
                     
                }
                ShoppingcartCart::destroy(); 
    
             
                return Redirect::route('payment');
        }
        else
        {
            return Redirect::back()->with(['warning' => 'Giỏ Hàng Chưa Có Sản Phẩm']);
        }
     
    }

    public function payment()
    {   
        $user = Auth()->user();
        $CartShow = Shoping::with(['shoping_has_product','shoping_has_information'])
                        ->where('customer_id',$user->id)
                        ->get();
        return view('page.cart.payment',compact('CartShow'));
    }

    public function inforOrderNew()
    {
         return view('page.cart.inforOrderNew');
    }

    public function save_inforOrder(Request $request)
    {
        $rules =[
            'email'=>'required|email',
            'name'=>'required',
            'phone'=>'required|numeric',
            'address'=>'required',
            'city'=>'required',
            'district'=>'required',
            'ward'=>'required',
          ];
        $request->validate($rules);
        
        $information = new Information();
         $information->customer_id = Auth::user()->id;
         $information->name = $request->name ;
         $information->email = $request->email;
         $information->phone = $request->phone;
         $information->address = $request->address .' '. $request->ward .' '. $request->district .' '. $request->city ;
         $information->note = $request->note ?? '';
         $information->save();
         
         return redirect()->route('show_cart')->with(['success' => 'Thêm Thông Tin Thành Công']);
    }
}
