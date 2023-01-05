
  <header>
  <div class="container-fluid">
      <div class="nav top-toolbar row">
        <div class=" ml-2 text-white p-2 pb-0 col-8">
          <div class="  pt-0 pr-2 row" style="">
            @php
            $set = DB::table('settings')
                  ->select('*')->where('lang', '2')
                  ->get();
            @endphp
            <i class="fa fa-phone fa-flip-horizontal pr-3 font-weight-bold"></i>&nbsp;
            @foreach($set as $settings->h)
            <b><span>{{$h->phone}}</span></b>

            <i class="fa fa-envelope font-weight-bold ml-2 pl-2" style="border-left: 1px solid #29387a5e;"></i>&nbsp;
            <span>{{$h->email}}</span>
            <i class="fa fa-map-marker-alt font-weight-bold ml-2 pl-2" style="border-left: 1px solid #29387a5e;"><span class="header_alamat" style="  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">{{$h->address}}</span></i>&nbsp;

            @endforeach
          </div>
        </div>
        @php
        $lang = DB::table('languages')
                 ->select('*')->where('lang', '2')
                 ->get();
        @endphp
        <div class=" ml-auto text-white p-2 mr-3 pb-0" style=" font-size: 16px">
        <?php $k = 1;?>
        @foreach($lang as $l)
          <?php if($k % 2 == 0){
            echo "|";
          }
          $k++;
          ?>
          <a href="/-{{$l->tag}}" class=" text-white text-decoration-none">{{$l->tag}}</a>
          @endforeach
        </div>
      </div>
    </div>

@php
    $settings=DB::table('settings')->limit(1)->get();

@endphp


<nav class="navbar navbar-expand-lg navbar-light bg-white">

       <div class="navbar-header" style="margin-bottom:5px">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <a class="navbar-brand text-right" href="/">
             @foreach($set as $h)
           <img src="{{$h->logo}}" class=" img-resimg-responsive img-rounded " height="52px" width="120px" alt="logo">
           @endforeach
         </a>


       </div>
       <div class="collapse navbar-collapse bg-white"id="navbarNav" style="z-index:80">
         <ul class="navbar-nav mr-auto ml-auto">
         @php
           $menu=DB::table('menus')->where('group_id','2')->where('lang',$bahasa)->get();
       @endphp
           @foreach($menu as $m)
           <?php
           if($m->parent_id == '0'){
             $main = $m->id;
             $link = '#';
             $slug=DB::table('pages')->get();
             foreach($slug as $s){
               if ($m->url == $s->id){
                 $link = $s->slug;
               }
             }
             $child = "NO";
             foreach($menu as $b){
               if($b->parent_id == $main){
                 $child = "YES";
               }
             }
             if($child == "YES"){?>
                   <li class="nav-item dropdown">
                     <a href="{{$link}}" class="parent ">{{$m->title}}<i class="fa fa-sort-down titik" style=" float:right;"></i>&nbsp;</a>

                       <ul class="block-sub">
             <?php
             }
             else{?>
                 <li>
               <a href="{{$link}}" class="parent">{{$m->title}}</a>
             <!-- PARENT KEDUA -->
             <?php
             }
             foreach($menu as $b){
               if($b->parent_id == $main){
                 $sub = $b->id;
                 $link = '#';
                 $slug=DB::table('pages')->get();
                 foreach($slug as $s){
                   if ($b->url == $s->id){
                     $link = $s->slug;
                   }
                 }
                 $child2="NO";
                 foreach($menu as $c){
                   if($c->parent_id == $sub){
                     $child2="YES";}
                 }
                 if($child2 == "YES"){
                 ?>
                     <li class="nav-item dropdown">
                       <a href="{{$link}}" class="sub-cild">{{$b->title}}<i class="fa fa-sort-down" style="margin-right:5%; float:right;"></i>&nbsp;</a>
                         <ul class="block-sub block-sub2" style="z-index:20;">

                 <?php
                 }else{?>
                       <li class="nav-item dropdown"><a href="{{$link}}" class=" sub-cild">{{$b->title}}</a>
                 <?php
                 }
                 ?>
                       @foreach($menu as $c)
                       <?php
                         if($c->parent_id == $sub){
                           $link = '#';
                           $slug=DB::table('pages')->get();
                           foreach($slug as $s){
                             if ($c->url == $s->id){
                               $link = $s->slug;
                             }
                           }?>
                         <li class="nav-item dropdown">
                             <a href="{{$link}}" class="sub-cild">{{$c->title}}</a>
                         </li>
                       <?php
                         }
                         ?>
                         @endforeach
                         <?php if($child2 == "YES"){
                           echo "</ul>";
                         } ?>
                   </li>
             <?php
               }
             }
             if($child == "YES"){
               echo "</ul>";
             }
               ?>
           </li>
           <?php
           }
           ?>
           @endforeach
         </ul>
       </div>
     </nav>
    </div>
  </header>
