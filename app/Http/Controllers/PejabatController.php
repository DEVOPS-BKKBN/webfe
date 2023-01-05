<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pejabat;
use App\Models\Jabatan;
use App\Models\Language;
use Illuminate\Support\Str;
class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pejabat=Pejabat::orderBy('id','DESC')->paginate(10);
        return view('backend.pejabat.index')->with('pejabats',$pejabat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang = Language::where('status','active')->get();
        return view('backend.pejabat.create')->with('lang',$lang);
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
            'nama'=>'string|required|max:50',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'jabatan'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $slug=Str::slug($request->title);
        $count=Pejabat::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        $status=Pejabat::create($data);
        if($status){
            request()->session()->flash('success','Pejabat successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding pejabat');
        }
        return redirect()->route('pejabat.index');
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
        $pejabat=Pejabat::findOrFail($id);
        $jabatan=Jabatan::get();
        $lang = Language::where('status','active')->get();
        return view('backend.pejabat.edit')->with('pejabat',$pejabat)->with('lang',$lang);
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
        $pejabat=Pejabat::findOrFail($id);
        $this->validate($request,[
            'lang' => 'required',
            'nama'=>'string|required|max:50',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'jabatan'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $status=$pejabat->fill($data)->save();
        if($status){
            request()->session()->flash('success','Pejabat successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating pejabat');
        }
        return redirect()->route('pejabat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pejabat=Pejabat::findOrFail($id);
        $status=$pejabat->delete();
        if($status){
            request()->session()->flash('success','Pejabat successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting pejabat');
        }
        return redirect()->route('pejabat.index');
    }
}
