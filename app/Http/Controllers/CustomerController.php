<?php

namespace App\Http\Controllers;

use App\Repositories\Customer\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomerController extends Controller
{
     /**
     * @var CustomerController
     */
    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;

    }

    public function index()
    {
          $data =  $this->repository->with('user_has_shoping')->get();
          return view('admin.customer.all', compact('data'));
    }

   public function show(CustomerRepository  $repository, $id)
   {
        $User = $repository->find($id);

        return view('home.User', compact('User'));
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
}
