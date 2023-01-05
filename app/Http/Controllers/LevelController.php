<?php

namespace App\Http\Controllers;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Models\Cart;
class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level=Level::orderBy('id','DESC')->paginate('10');
        return view('backend.level.index')->with('levels',$level);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.level.create');
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
            'code'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        $status=Level::create($data);
        if($status){
            request()->session()->flash('success','Level Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('level.index');
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
        $level=Level::find($id);
        if($level){
            return view('backend.level.edit')->with('level',$level);
        }
        else{
            return view('backend.level.index')->with('error','Level not found');
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
        $level=Level::find($id);
        $this->validate($request,[
            'code'=>'string|required',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();

        $status=$level->fill($data)->save();
        if($status){
            request()->session()->flash('success','Level Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('level.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level=Level::find($id);
        if($level){
            $status=$level->delete();
            if($status){
                request()->session()->flash('success','Level successfully deleted');
            }
            else{
                request()->session()->flash('error','Error, Please try again');
            }
            return redirect()->route('level.index');
        }
        else{
            request()->session()->flash('error','Level not found');
            return redirect()->back();
        }
    }

    public function levelStore(Request $request){
        $level=Level::where('code',$request->code)->first();
        if(!$level){
            request()->session()->flash('error','Invalid level code, Please try again');
            return back();
        }
        if($level){
            $total_price=Cart::where('user_id',auth()->user()->id)->where('order_id',null)->sum('price');
            session()->put('level',[
                'id'=>$level->id,
                'code'=>$level->code,
                'value'=>$level->discount($total_price)
            ]);
            request()->session()->flash('success','Level successfully applied');
            return redirect()->back();
        }
    }
}
