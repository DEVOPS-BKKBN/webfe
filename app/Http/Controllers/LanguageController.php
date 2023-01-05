<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Settings;
use Illuminate\Support\Str;
class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $language=Language::orderBy('id','DESC')->paginate(10);
        return view('backend.language.index')->with('language',$language);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.language.create');
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
            'lang'=>'string|required',
            'status'=>'required|in:active,inactive',
            'tag' => 'required',
        ]);
        
        $data=$request->all();
        $status=Language::create($data);
        $post = Settings::create([
            'lang'=>$status->tag
        ]);
        if($status){
            request()->session()->flash('success','Language Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('language.index');
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
        $language=Language::findOrFail($id);
        return view('backend.language.edit')->with('language',$language);
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
        $language=Language::findOrFail($id);
         // return $request->all();
         $this->validate($request,[
            'lang'=>'string|required',
            'status'=>'required|in:active,inactive',
            'tag' => 'required',
        ]);
        $data=$request->all();
        $status=$language->fill($data)->save();
        if($status){
            request()->session()->flash('success','Post Category Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('language.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language=Language::findOrFail($id);
       
        $status=$language->delete();
        
        if($status){
            request()->session()->flash('success','Post Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting post category');
        }
        return redirect()->route('language.index');
    }
}
