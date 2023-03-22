<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Shoping;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Shoping\ShopingRepository;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class MannagentController extends Controller
{
     /**
     * @var CustomerController
     */
    protected $repository;
    protected $shopingRepository;
    
    public function __construct(CartRepository $repository, ShopingRepository $shopingRepository)
    {

        $this->repository = $repository;
        $this->shopingRepository = $shopingRepository;

    }
    
    public function index()
    {
       
          $data = Shoping::with(['shoping_has_customer','shoping_has_information','shoping_has_product'])
                         ->where('status',1)
                         ->get();
          return view('admin.management.all_order',compact('data'));
    }

   public function show()
   {
       // $User = $repository->find($id);

        return view('home.User', compact('User'));
   }

   public function order($id)
   {
          $shoping = $this->shopingRepository->with('shoping_has_product')->find($id);
          $order = $this->repository->create([
               'shoping_id' => $id,
               'price' => $shoping->shoping_has_product->product_price ,
               'status' => 1
          ]);

          if($order)
               {
                    Shoping::where('id',$id)->update(['status' => 2]);
               }
          return redirect()->back()->with('success','Đã xác nhận đơn hàng');
   }

   public function store(Request $request)
   {
        $data = $request->all();

        //... Validation here

        $User = $this->repository->createOrFail($data);

        return view('home.User', compact('User'));
   }

   public function update(Request $request, $id)
   {
        $data = $request->all();
     
        $User = $this->repository->findOrFail($id);
        $User->update($data);

        return view('home.User', compact('User'));
   } 

   public function destroy($id)
   {
        $User = $this->repository->findOrFail($id);
        $User->delete();

        return view('home.User', compact('User'));
   }

   public function order_details()
   {
          // $data = Cart::join('tbl_shopping', 'tbl_shopping.tbl_shopping_id')
        
        dd($table1);
   }
   

   public function pdf()
   {
     $user = Auth::user() ;
     dd($user);

     $pdf = PDF::loadView('pdf', compact('data'));
     
         
     // dd($data);
     //Nếu muốn hiển thị file pdf theo chiều ngang
     // $pdf->setPaper('A4', 'landscape');
     
     //Nếu muốn download file pdf
     //return $pdf->download('myPDF.pdf');
     
     //Nếu muốn preview in pdf
     return $pdf->stream('pdf',[$data,$sumPrice,$user]);
   }


}
