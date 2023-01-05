
  <footer class="footer footer-large bg-dark" id="footer">
    <div class="row row-cols-1 row-cols-md-3 border-0 ml-2 mr-2 mt-0"
      style="border-bottom: 1px solid rgba(204, 204, 204, 0.493);">
      <div class="col pl-1 pr-1 pb-0">
        <div class="card border-0 text-white  bg-transparent" style="box-shadow: none !important;">
          <div class="card-body">@php $set = DB::table('settings')->select('*')->get(); @endphp
            <a class="navbar-brand font-weight-bold text-white pb-2" style="font-size: x-large;" href="#">BKKBN</a>
            <p class=" text-white">@foreach($set as $data) {!! html_entity_decode($data->description) !!} @endforeach</p>
            <div class=" pt-1 pb-1 " style="font-size: 15px;">
              <span class="fa fa-map-marker-alt" style="font-size: 20px;color: #1976d2;"></span>&nbsp;
              <p class="text-left position-reltive" style="margin-left:30px; margin-top:-25px;"> @foreach($set as $data) {{$data->address}} @endforeach</p>
            </div>
            <div class=" pt-1 pb-1 " style="font-size: 15px;">
              <span class="fa fa-phone fa-flip-horizontal " style="font-size: 20px;color: #1976d2;"></span>&nbsp;
              <p class="text-left position-reltive" style="margin-left:30px; margin-top:-25px;">@foreach($set as $data) {{$data->phone}} @endforeach</p>
            </div>
            <div class=" pt-1 pb-1 " style="font-size: 15px;">
              <span class="fa fa-envelope" style="font-size: 20px;color: #1976d2;"></span>&nbsp;
              <p class="text-left position-reltive" style="margin-left:30px; margin-top:-25px;">@foreach($set as $data) {{$data->email}} @endforeach</p>
            </div>
            <div class=" pt-1 pb-1 " style="font-size: 15px;">
              <span class="fa fa-clock" style="font-size: 20px;color: #1976d2;"></span>&nbsp; 
              <p class="text-left position-reltive" style="margin-left:30px; margin-top:-25px;">@foreach($set as $data) {{$data->layanan}} @endforeach</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col pb-0 ">
        <div class="card border-0 text-white bg-transparent " style="box-shadow: none !important;">
          <div class="card-body">
            <span></span>
          </div>
        </div>
      </div>
      <div class="col pl-1 pr-1 pb-0">
        <div class="card border-0 text-white  bg-transparent" style="box-shadow: none !important;">
          <div class="card-body">
          <?php
          $agen=DB::table('labels')->where('lang',$bahasa)->where('kondisi','ikuti')->get();
          foreach($agen as $a){
            echo '<span class="navbar-brand font-weight-bold text-white pb-3 pt-3" style="font-size: x-large;">'.$a->title.'</span>';
          }
          ?>
            <div class="item-footer ">
              <p class=" pt-2 pb-2 ">
                  <?php
                $sosmed =  DB::table('sosmeds')->get();
                foreach ($sosmed as $s){
                echo '<a href="'.$s->description.'" class="footer-medsos  pr-2 pl-2 text-white-50 font-italic"><i
                    class="fab  fa-'.$s->slug.' footer-medsos" style="font-size: 45px;" target="_blank"></i></a>';
                }
                ?>
              </p>
            </div>
            <span class="navbar-brand font-weight-bold text-white pb-3 pt-3">
            <div class="item-footer  text-right" >
            <?php
            $agen=DB::table('labels')->where('lang',$bahasa)->where('kondisi','hit')->get();
            foreach($agen as $a){
              echo '<span class="navbar-brand text-white " style="font-size: large;font-weight:600; left:50%; ">'.$a->title.'</span>';
            }

               
                $tanggal = date('Y-m-d');
                $date = date('d-M-Y');
                $online = 0;
                $visitor=DB::table('visitors')->where('tanggal',$date)->get();
                if (isset($visitor)){
                  foreach($visitor as $data) {
                    $online = $data->count;
                   }
                }
                  if( !isset($_COOKIE['visitor'])){
                    $duration = time()+60*24;
                    setcookie('visitor','visit',$duration);
                    if( $online != "0" ){
                      DB::table('visitors')->where('tanggal',$date)->increment('count', 1);
                    }else{
                      DB::insert('insert into visitors (count, date, tanggal) values (?, ?, ?)', [1, $tanggal, $date]);
                    }
                  }
                  $mo = '%'.date('M').'%';
                  
                  $month = DB::table('visitors')->where('tanggal','like',$mo)->get()->sum('count');


                  $count = DB::table('visitors')->get()->sum('count');
                ?>
              
              <p class=" text-white " style="font-size: 15px;">
                Online &nbsp; : &nbsp;<span class=" font-weight-bold">
                <?php

                $visitor=DB::table('visitors')->where('tanggal',$date)->get();
                if (isset($visitor)){
                  foreach($visitor as $data) {
                    $online = $data->count;

                   }
                }
                 echo $online;
                ?>
              </span></p>

              
              <p class=" text-white " style="font-size: 15px;">
                <?php
                $agen=DB::table('labels')->where('lang',$bahasa)->where('kondisi','bulan')->get();
                foreach($agen as $a){
                  echo $a->title.' '.date('F');
                }?> &nbsp; : &nbsp;<span class=" font-weight-bold"></span><?php echo $month ?>
              </p>
              <p class=" text-white " style="font-size: 15px;">
                Total &nbsp; : &nbsp;<span class=" font-weight-bold"></span><?php echo $count ?>
              </p>
            </div>
          </span>


          </div>
        </div>
      </div>
    </div>
    <div class=" mt-4 mb-0 pt-2 pb-2 ml-auto mr-auto"
      style="border-top: 1px solid rgba(204, 204, 204, 0.493);width: 90%;font-size: large;">
      <div class="row row-cols-2 row-cols-md-2">
        <div class="col">
          <p class=" d-inline text-white text-left " style="font-size:12px">Copyright
            © 2020 BKKBN. All
            Rights Reserved</p>
        </div>
        <div class="col text-right" style="float:right">
          <p class=" d-inline text-white-50 text-right" style="font-size:15px;font-weight: 500;">
            <a href="" class="text-white text-decoration-none" style="border-right:1px solid #ffff;padding-right:5px;">
            <?php
            $agen=DB::table('labels')->where('lang',$bahasa)->where('kondisi','beranda')->get();
            foreach($agen as $a){
              echo $a->title;
            }
            $bahas=DB::table('languages')->where('id',$bahasa)->get();
            ?></a>
            @foreach($bahas as $b)
            <a href="/petasitus-{{$b->tag}}" class="text-white text-decoration-none" style="border-right:1px solid #ffff;padding-right:5px">
            @endforeach
            <?php
            $agen=DB::table('labels')->where('lang',$bahasa)->where('kondisi','peta')->get();
            foreach($agen as $a){
              echo $a->title;
            }
            ?>
            </a>
            <!--  -->
            <a href="mailto:bkkbn@gmail.com?subject=Subject atau judul disini&body=Pesan tulisan yang di tubuh disini" class="text-white text-decoration-none" style="padding-left:5px">EMAIL</a>
          </p>
        </div>
      </div>
    </div>

    @php
        $agenda=DB::table('agendas')->get();
    @endphp
  </footer>
   
  
