<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pages;
use App\Models\Language;
use Illuminate\Support\Str;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu=Menu::orderBy('id','DESC')->paginate(10);
        $pages = Pages::where('status','active')->get();
        $lang = Language::where('status','active')->get();
        return view('backend.menu.index')->with('menu',$menu)->with('pages',$pages)->with('lang',$lang);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::where('active','Y')->get();
        $pages = Pages::where('status','active')->get();
        $lang = Language::where('status','active')->get();
        return view('backend.menu.create')->with('menu',$menu)->with('pages',$pages)->with('lang',$lang);
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
            'parent_id'=>'required',
            'title' => 'required',
            'url' => 'required',
            'class' => 'required',
            'position' => 'required',
            'url' => 'required',
            'group_id' => 'required',
            'active' => 'required|in:Y,N',
            'target' => 'required',
        ]);
        $data=$request->all();
        $status=Menu::create($data);
        if($status){
            request()->session()->flash('success','menu Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($grup)
    {
        $menu=Menu::where('lang',$grup)->orderBy('id','DESC')->paginate(10);
        $pages = Pages::where('status','active')->get();
        return view('backend.menu.index')->with('menu',$menu)->with('pages',$pages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu=Menu::findOrFail($id);
        $pages = Pages::where('status','active')->get();
        $par = Menu::where('active','Y')->get();
        $lang = Language::where('status','active')->get();
        return view('backend.menu.edit')->with('menu',$menu)->with('par',$par)->with('pages',$pages)->with('lang',$lang);
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
        $menu=Menu::findOrFail($id);
         // return $request->all();
         $this->validate($request,[
            'parent_id'=>'required',
            'title' => 'required',
            'url' => 'required',
            'class' => 'required',
            'position' => 'required',
            'group_id' => 'required',
            'active' => 'required|in:Y,N',
            'target' => 'required',
        ]);
        $data=$request->all();
        $status=$menu->fill($data)->save();
        if($status){
            request()->session()->flash('success','Post Category Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu=Menu::findOrFail($id);

        $status=$menu->delete();

        if($status){
            request()->session()->flash('success','Menu successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting menu');
        }
        return redirect()->route('menu.index');
    }
}
