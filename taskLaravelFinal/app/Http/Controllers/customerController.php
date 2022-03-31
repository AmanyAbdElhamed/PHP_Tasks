<?php

namespace App\Http\Controllers;


use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = users::get();
        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "name"   => "required|min:3",
            "email"  => "required|email|unique:users",
            "password" => ["required", Password::min(6)->letters()]
        ]);


        $data['password'] = bcrypt($data['password']);

        $op =   users::create($data);

        if ($op) {
            $message = 'Raw Inserted';
        } else {
            $message = 'Error Try Again';
        }


        session()->flash('Message', $message);

        return redirect(url('/User/'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = users::find($id);

        return view('users.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            "name" => "required",
            "email" => "required|email"
        ]);


        $op = users::where('id', $id)->update($data);

        if ($op) {
            $message = "Raw Updated";
        } else {
            $message = "Error Try Again";
        }


        session()->flash('Message', $message);

        return redirect(url('/User/'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $op = users::where('id', $id)->delete();

        if ($op) {
            $message = 'Raw Removed';
        } else {
            $message = 'Error Try Again';
        }

        session()->flash('Message', $message);

        return redirect(url('/User/'));
    }
    public function login()
    {
        return view('users.login');
    }


    public function doLogin(Request $request)
    {



        $data = $this->validate($request, [
            "email"  => "required|email",
            "password" => ["required", Password::min(6)->letters()]
        ]);


        if (auth()->attempt($data)) {

            return  redirect(url('/Task/'));
        } else {
            session()->flash('Message', 'Error IN your Cred Try Again');
            return  redirect(url('/Login/'));
        }
    }

    public function logOut()
    {

        auth()->logout();

        return  redirect(url('/Login/'));
    }
}
