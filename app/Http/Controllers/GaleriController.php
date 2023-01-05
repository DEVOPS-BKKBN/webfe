<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Str;
class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeri=Galeri::orderBy('id','DESC')->paginate(10);
        return view('backend.galeri.index')->with('galeri',$galeri);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.galeri.create');
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
            'photo'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $status=Galeri::create($data);
        if($status){
            request()->session()->flash('success','Galeri successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding galeri');
        }
        return redirect()->route('galeri.index');
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
        $galeri=Galeri::findOrFail($id);
        return view('backend.galeri.edit')->with('galeri',$galeri);
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
        $galeri=Galeri::findOrFail($id);
        $this->validate($request,[
            'photo'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $status=$galeri->fill($data)->save();
        if($status){
            request()->session()->flash('success','Galeri successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating galeri');
        }
        return redirect()->route('galeri.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galeri=Galeri::findOrFail($id);
        $status=$galeri->delete();
        if($status){
            request()->session()->flash('success','Galeri successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting galeri');
        }
        return redirect()->route('galeri.index');
    }
}
