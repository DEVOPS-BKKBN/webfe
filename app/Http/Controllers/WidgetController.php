<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Widget;
use Illuminate\Support\Str;
class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widget=Widget::orderBy('id','DESC')->paginate(10);
        return view('backend.widget.index')->with('widget',$widget);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.widget.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required',
            'embed'=>'string|required',
            'side'=>'required|in:kiri,kanan',
            'status'=>'required|in:active,inactive',
        ]);
        
        $data=$request->all();
        $status=Widget::create($data);
        if($status){
            request()->session()->flash('success','Widget Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('widget.index');
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
        $widget=Widget::findOrFail($id);
        return view('backend.widget.edit')->with('widget',$widget);
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
        $widget=Widget::findOrFail($id);
         $this->validate($request,[
            'title'=>'string|required',
            'embed'=>'string|required',
            'side'=>'required|in:kiri,kanan',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $status=$widget->fill($data)->save();
        if($status){
            request()->session()->flash('success','Widget Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('widget.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $widget=Widget::findOrFail($id);
       
        $status=$widget->delete();
        
        if($status){
            request()->session()->flash('success','Widget successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting post category');
        }
        return redirect()->route('widget.index');
    }
}
