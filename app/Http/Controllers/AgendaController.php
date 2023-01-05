<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Language;
use Illuminate\Support\Str;
class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agenda=Agenda::orderBy('id','DESC')->paginate(10);
        return view('backend.agenda.index')->with('agendas',$agenda);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang = Language::where('status','active')->get();
        return view('backend.agenda.create')->with('lang',$lang);
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
            'title'=>'string|required|max:50',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'pejabat'=>'string|required',
            'status'=>'required|in:active,inactive',
            'tanggal'=>'required',
        ]);
        $data=$request->all();
        $slug=Str::slug($request->title);
        $count=Agenda::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        // return $slug;
        $status=Agenda::create($data);
        if($status){
            request()->session()->flash('success','Agenda successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding agenda');
        }
        return redirect()->route('agenda.index');
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
        $agenda=Agenda::findOrFail($id);
        $lang = Language::where('status','active')->get();
        return view('backend.agenda.edit')->with('agenda',$agenda)->with('lang',$lang);
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
        $agenda=Agenda::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required|max:50',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'required|in:active,inactive',
            'tanggal'=>'required',
        ]);
        $data=$request->all();
        $status=$agenda->fill($data)->save();
        if($status){
            request()->session()->flash('success','Agenda successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating agenda');
        }
        return redirect()->route('agenda.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda=Agenda::findOrFail($id);
        $status=$agenda->delete();
        if($status){
            request()->session()->flash('success','Agenda successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting agenda');
        }
        return redirect()->route('agenda.index');
    }
}
