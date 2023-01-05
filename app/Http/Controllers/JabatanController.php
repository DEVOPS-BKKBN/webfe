<?php

namespace App\Http\Controllers;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Models\Cart;
class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan=Jabatan::orderBy('id','DESC')->paginate('10');
        return view('backend.jabatan.index')->with('jabatans',$jabatan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.jabatan.create');
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
            'code'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        $status=Jabatan::create($data);
        if($status){
            request()->session()->flash('success','Jabatan Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('jabatan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jabatan=Jabatan::find($id);
        if($jabatan){
            return view('backend.jabatan.edit')->with('jabatan',$jabatan);
        }
        else{
            return view('backend.jabatan.index')->with('error','Jabatan not found');
        }
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
        $jabatan=Jabatan::find($id);
        $this->validate($request,[
            'code'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();

        $status=$jabatan->fill($data)->save();
        if($status){
            request()->session()->flash('success','Jabatan Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('jabatan.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan=Jabatan::find($id);
        if($jabatan){
            $status=$jabatan->delete();
            if($status){
                request()->session()->flash('success','Jabatan successfully deleted');
            }
            else{
                request()->session()->flash('error','Error, Please try again');
            }
            return redirect()->route('jabatan.index');
        }
        else{
            request()->session()->flash('error','Jabatan not found');
            return redirect()->back();
        }
    }

    public function jabatanStore(Request $request){
        $jabatan=Jabatan::where('code',$request->code)->first();
        if(!$jabatan){
            request()->session()->flash('error','Invalid jabatan code, Please try again');
            return back();
        }
        if($jabatan){
            $total_price=Cart::where('user_id',auth()->user()->id)->where('order_id',null)->sum('price');
            session()->put('jabatan',[
                'id'=>$jabatan->id,
                'code'=>$jabatan->code,
                'value'=>$jabatan->discount($total_price)
            ]);
            request()->session()->flash('success','Jabatan successfully applied');
            return redirect()->back();
        }
    }
}
