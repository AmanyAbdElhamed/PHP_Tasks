<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    
    public function createBlog(){
        return view('createblog');

    }
    public function Access(Request $request){
        $data=$this->validate($request,[
            "title"=>"required|string",
            "content"=>"required|min:50",
            "image"=>"required|image|mimes:jpeg,png,jpg"

        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

       // dd($data);

        $_COOKIE['Blog']=$data;
        print_r($_COOKIE['Blog']);
        //$request->session()->put('Blog', $data);


    }
}
