<?php

namespace App\Http\Controllers;
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
      
        return view('admin.Admin');
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
