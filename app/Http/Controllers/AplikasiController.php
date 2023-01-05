<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;
use Illuminate\Support\Str;
class AplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aplikasi=Aplikasi::orderBy('id','DESC')->paginate(10);
        return view('backend.aplikasi.index')->with('aplikasis',$aplikasi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.aplikasi.create');
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
            'title'=>'string|required|max:50',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'required|in:active,inactive',
            'slug' => 'required',
        ]);
        $data=$request->all();
        $status=Aplikasi::create($data);
        if($status){
            request()->session()->flash('success','Aplikasi successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding aplikasi');
        }
        return redirect()->route('aplikasi.index');
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
        $aplikasi=Aplikasi::findOrFail($id);
        return view('backend.aplikasi.edit')->with('aplikasi',$aplikasi);
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
        $aplikasi=Aplikasi::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required|max:50',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'required|in:active,inactive',
            'slug' => 'required',
        ]);
        $data=$request->all();
        $status=$aplikasi->fill($data)->save();
        if($status){
            request()->session()->flash('success','Aplikasi successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating aplikasi');
        }
        return redirect()->route('aplikasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aplikasi=Aplikasi::findOrFail($id);
        $status=$aplikasi->delete();
        if($status){
            request()->session()->flash('success','Aplikasi successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting aplikasi');
        }
        return redirect()->route('aplikasi.index');
    }
}
