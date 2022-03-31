<?php

namespace App\Http\Controllers;

use App\Models\tasks;
use Illuminate\Http\Request;

class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = tasks::join('users', 'users.id', '=', 'tasks.addedBy')
            ->select('tasks.*', 'users.name as username')
            ->where('addedBy', auth()->user()->id)
            ->get();
        return view('tasks.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Task|Create";
        return view('tasks.create', compact('title'));
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
            'title'     => "required|min:3",
            "content"   => "required|min:100",
            "startDate" => "required|date|after_or_equal:today",
            "endDate"   => "required|date|after_or_equal:startDate",
            "image"     => "required|image|mimes:png,jpg"
        ]);

        $FileName = time() . rand() . '.' . $request->image->extension();

        if ($request->image->move(public_path('tasks'), $FileName)) {


            $data['image']      = $FileName;
            $data['addedBy']    = auth()->user()->id;
            $data['startDate']  = strtotime($data['startDate']);
            $data['endDate']    = strtotime($data['endDate']);

            $op =  tasks::create($data);

            if ($op) {
                $message = "Raw Inserted";
            } else {
                $message = "Error Try Again";
            }
        } else {
            $Message = "Error In Uploading Image Try Again";
        }

        session()->flash('Message', $message);
        return redirect(url('/Task'));
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
        $data = tasks::find($id);
        return view('tasks.edit', compact('data'));
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
            'title'     => "required|min:3",
            "content"   => "required|min:100",
            "startDate" => "required|date|after_or_equal:today",
            "endDate"   => "required|date|after_or_equal:startDate",
            "image"     => "nullable|image|mimes:png,jpg"
        ]);


        $Raw = tasks::find($id);

        if ($request->hasFile('image')) {

            $FileName = time() . rand() . '.' . $request->image->extension();

            if ($request->image->move(public_path('tasks'), $FileName)) {

                unlink(public_path('tasks/' . $Raw->image));
            }

            $data['image'] =  $FileName;
        } else {
            $data['image'] = $Raw->image;
        }


        $data['startDate'] = strtotime($data['startDate']);
        $data['endDate']   = strtotime($data['endDate']);

        $op =  tasks::where('id', $id)->update($data);

        if ($op) {
            $message = "Raw Updated";
        } else {

            $message = "Error Try Again";
        }

        session()->flash('Message', $message);

        return redirect(url('/Task'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = tasks::find($id);

        $op = tasks::where('id', $id)->delete();

        if ($op) {

            unlink(public_path('tasks/' . $data->image));

            $message = "Raw Removed";
        } else {

            $message = "Error Try Again";
        }

        session()->flash('Message', $message);

        return redirect(url('/Task'));
    }

}
