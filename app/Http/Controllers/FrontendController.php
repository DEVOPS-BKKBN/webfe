<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Aplikasi;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\User;
use App\Models\Menu;
use App\Models\Agenda;
use App\Models\Language;
use App\Models\Settings;
use App\Models\Pages;
use App\Models\Visitors;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }


    public function home(){
        $bahasa = '2';
        $posts=Post::where('lang','2')->where('status','active')->where('post_cat_id',10)->orderBy('id','DESC')->limit(3)->get();
        $banners=Banner::where('status','active')->limit(10)->orderBy('id','DESC')->get()->toJson(JSON_PRETTY_PRINT);
        $aplikasis=Aplikasi::where('status','active')->limit(8)->orderBy('id','DESC')->get();
        $settings = Settings::where('lang',$bahasa)->get();
        $menu=Menu::where('group_id','2')->where('active','Y')->get();
        $agenda = Agenda::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        $lang = Language::where('status','active')->get();
        $set = Settings::where('lang',$bahasa)->get();
        //$set = DB::table('settings')
                //->select('*')
                //->get();
        return view('frontend.index')
                ->with('posts',$posts)
                ->with('banners',$banners)
                ->with('aplikasis',$aplikasis)
                ->with('menu',$menu)
                ->with('agenda',$agenda)
                ->with('lang',$lang)
                ->with('bahasa',$bahasa)
                ->with('set',$set);
    }
    public function lang($langg){
        $l = Language::where('tag',$langg)->get();
        foreach($l as $a){
            $bahasa = $a->id;
        }
        $posts=Post::where('lang',$bahasa)->where('status','active')->where('post_cat_id','10')->orderBy('id','ASC')->limit(3)->get();
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        $aplikasis=Aplikasi::where('status','active')->limit(8)->orderBy('id','DESC')->get();
        $menu=Menu::where('group_id','2')->where('active','Y')->get();
        $agenda = Agenda::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        $lang = Language::where('status','active')->get();
        $set = Settings::where('lang',$bahasa)->get();
        return view('frontend.index')
                ->with('posts',$posts)
                ->with('banners',$banners)
                ->with('aplikasis',$aplikasis)
                ->with('menu',$menu)
                ->with('agenda',$agenda)
                ->with('lang',$lang)
                ->with('bahasa',$bahasa)
                ->with('set',$set);
    }
    
    public function peta($langg){
        $lang = Language::where('status','active')->get();
        $l = Language::where('tag',$langg)->get();
        foreach($l as $a){
            $bahasa = $a->id;
        }
        return view('frontend.pages.petasitus')->with('bahasa',$bahasa)
        ->with('lang',$lang);;
    }

    public function pages($semua){
        $pages = DB::table('pages')->where('link',$semua)->get();
        foreach($pages as $a){
            $bahasa = $a->lang;
        }
        $lang = Language::where('status','active')->get();
        return view('frontend.pages.pages')
                ->with('bahasa',$bahasa)
                ->with('pages',$pages)
                ->with('lang',$lang);
    }
    public function berita($judul){
        $post = DB::table('posts')->where('slug','/berita-'.$judul)->get();
        foreach($post as $a){
            $bahasa = $a->lang;
        }
        $lang = Language::where('status','active')->get();
        return view('frontend.pages.berita')
                ->with('bahasa',$bahasa)
                ->with('post',$post)
                ->with('lang',$lang);
    }
    public function pengumuman($judul){
        $post = DB::table('pengumumen')->where('slug','/pengumuman-'.$judul)->get();
        foreach($post as $a){
            $bahasa = $a->lang;
        }
        return view('frontend.pages.pengumuman')->with('bahasa',$bahasa)->with('post',$post);
    }
    
    public function cari(Request $request){
      //$user=User::orwhere('name','like','%'.$request->search.'%')->paginate(2);
      $posts=Post::orwhere('title','like','%'.$request->search.'%')
          ->orwhere('quote','like','%'.$request->search.'%')
          ->orwhere('summary','like','%'.$request->search.'%')
          ->orwhere('description','like','%'.$request->search.'%')
          ->orwhere('slug','like','%'.$request->search.'%')
          ->orderBy('id','DESC')
          ->paginate(5);
        $bahasa = 2;
      //return view('frontend.pages.paginate',compact('user'));
      return view('frontend.pages.cari',compact('posts'))->with('bahasa',$bahasa);
    }

    // Login
    public function login(){
        return view('frontend.pages.login');
    }
    public function loginSubmit(Request $request){
        $data= $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])){
            Session::put('user',$data['email']);
            request()->session()->flash('success','Successfully login');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        return back();
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    }
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
    }
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }
	
	public function category($cat){

	if($cat == "terbaru"){
	$posts=Post::orderBy('id', 'DESC')
		  ->paginate(5);
	} else {
	$cat = PostCategory::where('slug', 'like', $cat)->get();
		   foreach($cat as $a){
		   $id = $a->id;
	}
	$posts=Post::where('post_cat_id', 'like', $id)
		  ->orderBy('id', 'DESC')
		  ->paginate(5);
	}
	$bahasa = 2;
	
	return view('frontend.pages.category', compact('posts'))->with('bahasa', $bahasa);
	}

}
