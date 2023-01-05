<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sosmed;
use Illuminate\Support\Str;
class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sosmed=Sosmed::orderBy('id','DESC')->paginate(10);
        return view('backend.sosmed.index')->with('sosmeds',$sosmed);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sosmed.create');
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
        ]);
        $data=$request->all();
        $slug=Str::slug($request->title);
        $count=Sosmed::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        $status=Sosmed::create($data);
        if($status){
            request()->session()->flash('success','Sosmed successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding sosmed');
        }
        return redirect()->route('sosmed.index');
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
        $sosmed=Sosmed::findOrFail($id);
        return view('backend.sosmed.edit')->with('sosmed',$sosmed);
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
        $sosmed=Sosmed::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required|max:50',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $status=$sosmed->fill($data)->save();
        if($status){
            request()->session()->flash('success','Sosmed successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating sosmed');
        }
        return redirect()->route('sosmed.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sosmed=Sosmed::findOrFail($id);
        $status=$sosmed->delete();
        if($status){
            request()->session()->flash('success','Sosmed successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting sosmed');
        }
        return redirect()->route('sosmed.index');
    }
}
