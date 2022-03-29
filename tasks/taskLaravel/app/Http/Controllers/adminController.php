<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    public function create(){
        return view("admin.create");
    }
    public function store(Request $request){

     $data=$this->validate($request,[
      "name"=>"required|min:3",
      "email"=>"required|email|unique:admins",
      "password"=>["required", Password::min(6)->letters()]
     ]);

     $data["password"]=bcrypt($data["password"]);

     $op=admin::create($data);
     if($op){
         $message="Raw Inserted";
     }else{
         $message="Error Try again";
     }
     dd($message);
     session()->flash('Message',$message);
    }
    public function login(){
        return view('admin.login');
    }
    public function doLogin(Request $request){

        $data = $this->validate($request, [
            "email" => "required|email",
            "password" => ["required", Password::min(6)->letters()]
        ]);
       // dd($data);
        if(Auth::guard('admin')->attempt(['email'=>$request->email,
         'password' => $request->password])){
            dd('Logged ');
        }
        else{
            session()->flash('Message','Error Try again');
            return redirect(url('/Admin/login/'));
         }

    }
}
