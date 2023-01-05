<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Settings;
use App\Models\Language;
use Illuminate\Support\Str;
class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages=Pages::orderBy('id','DESC')->paginate(10);
        return view('backend.pages.index')->with('pages',$pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang = Language::where('status','active')->get();
        return view('backend.pages.create')->with('lang',$lang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'status'=>'required|in:active,inactive',
        ]);
        
        $data=$request->all();
        if($request->slug != ""){
            $slug = $request->slug;
        }else{
            $slug=Str::slug($request->title);
            $count=Pages::where('slug',$slug)->count();
            if($count>0){
                $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
            }
            $data['slug']="/pages-".$slug;
            
        }
        
        $data['link']=$slug;
        
        $status=Pages::create($data);
        if($status){
            request()->session()->flash('success','Pages Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('pages.index');
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
        $pages=Pages::findOrFail($id);
        $lang = Language::where('status','active')->get();
        return view('backend.pages.edit')->with('pages',$pages)->with('lang',$lang);
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
        $pages=Pages::findOrFail($id);
         $this->validate($request,[
            'status'=>'required|in:active,inactive',
            'title' => 'required',
            'lang' => 'required',
        ]);
        $data=$request->all();
        if($request->slug != ""){
            $slug = $request->slug;
            $data['slug']="/pages-".$slug;
        }else{
            $slug=Str::slug($request->title);
            $count=Pages::where('slug',$slug)->count();
            if($count>0){
                $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
            }
            $data['slug']="/pages-".$slug;
            
        }
        $data['link']=$slug;
        $status=$pages->fill($data)->save();
        if($status){
            request()->session()->flash('success','Post Category Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language=Pages::findOrFail($id);
       
        $status=$language->delete();
        
        if($status){
            request()->session()->flash('success','Post Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting post category');
        }
        return redirect()->route('pages.index');
    }
}
