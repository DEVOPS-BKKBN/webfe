@extends('frontend.include.master')

@section('main-content')
<div class="content">
    <link rel="manifest" href="{{ asset('frontend/js/manifest.json') }}">

<!-- BANNER START  -->
@if(count(json_decode($banners,true))>0)
  <div class="slider" id="slider">
    <div id="carouselExampleIndicators" class="carousel slide my-carousel my-carousel" data-ride="carousel">
      <div class="carousel-inner" aria-label="slider" >
        @foreach(json_decode($banners,true) as $key=>$banner)
        <div class="carousel-item carousel-banner {{(($key==0)? 'active' : '')}}" style="background-image: url('{{$banner['photo']}}'); background-size: 100% 100%">
          <div class="banner">
            <div class="inner-news ">
              <form method="GET" action="/cari">
                @csrf
              <div class="input-group input-group-lg ml-auto mr-auto">
                <input type="text" class="form-control h-100  bg-transparent" placeholder=""
                  aria-label="Recipient's username" name="search">
                <div class="input-group-append">
                  <button class="btn btn-primary  ml-0" type="submit" aria-label="Center Align" ><span class="fa fa-search"
                      style="font-size: x-large;"></span></button>
                </div>
              </div>
                </form>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev   bg-primary"
          style="margin-top: 15%;width: 4%;height:  8%;margin-left: 50px;border-radius: 45%;float: left; z-index:0;"
          href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon " aria-hidden="true" style="font-size: large;"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next  bg-primary"
          style="margin-top: 15%;width:  4%;height:  8%;margin-right: 50px;border-radius: 45%;float: right; z-index:0;"
          href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true" style="font-size: large;"></span>
          <span class="sr-only">Next</span>
        </a>
        @endforeach
      </div>
    </div>
  </div>
  @endif
<!-- BANNERS END  -->

<!-- BERITA START  -->
@if(count($posts)>0)
  <div class="form ml-auto mr-auto col-12">
    <div class="form-row ">
      <div class="slider container-fluid section-news" id="news">
        <div id="carouselNewsIndicators" class="carousel slide my-carousel my-carousel" data-ride="carousel">
          <ol class="carousel-indicators">
              @foreach($posts as $key=>$post)
          <li data-target="#carouselNewsIndicators" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
              @endforeach
          </ol>


          <div class="carousel-inner" aria-label="news">
                  @foreach($posts as $key=>$post)
                  <div class="carousel-item {{(($key==0)? 'active' : '')}} carousel-news  card-img-top carousel-cards"style="background-color:#003170;height: 250px;">

                    <img src="{{$post->photo}}" class="img-news float-left mt-4 ml-5 mr-3"  width="250px"
                      height="200px" alt="">
                      <div class="mt-4  news-ket text-white">
                        <a href="{{$post->slug}}" class="news-title text-decoration-none " style="color:#56a7ff"><?php echo \Illuminate\Support\Str::limit(strip_tags($post->title), 55, $end='...') ?></a>
                        <p  class=" text-warning-50 news-tanggal">{{$post->tanggal}}
                        </p>
                        <p class="news-dec"><?php echo \Illuminate\Support\Str::limit(strip_tags($post->description), 200, $end='...') ?></p>
                        <a href="{{$post->slug}}" class="font-weight-bold text-warning position-relative mt-4"
                          style="margin-left: auto;margin-right: auto;font-size: small;">Selengkapnya</a>
                      </div>

                  </div>
              @endforeach
          </div>


          <a class="carousel-control-prev bg-secondary  p-1 "
            style="width: 25px;margin-left: 0px;float: left;border-top-left-radius: 10px;border-top-right-radius: 10px; z-index:0;"
            href="#carouselNewsIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon " aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next bg-secondary   p-1 "
            style="width: 25px;margin-right: 0px;float: right;border-top-left-radius: 10px;border-top-right-radius: 10px; z-index:0;"
            href="#carouselNewsIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
@endif
<!-- BERITA END  -->

<!-- KEPALA & AGENDA START  -->
<?php
  $pej = DB::table('pejabats')->where('jabatan','Kepala BKKBN')->where('lang',$bahasa)->get();
  ?>
<div style="background-color:white">
 <main style="padding: 10px 1px;overflow: hidden;">
  <div class=" section-jumbo">
    <section id="form">
      <div class="container-fluid cols-12">
        <div class="row no-gutter ">
          <div class="col-md-12 col-sm-12 col-lg-5 mb-0 pejabat" style="background-color: #fff;">
            </br>
            <div class=" mt-1 mb-1 " >
            @foreach($pej as $p)
            <div class=" text-center ml-auto mr-auto">
              <img src="{{$p->photo}}" width="225" height="250" alt="">
              <h5 class=" font-weight-bold mt-2">{{$p->nama}}</h5>
              <h6>{{$p->jabatan}}</h6>
            </div>
            <div class=" ml-auto mr-auto p-4 mt-4 mb-2"
              style="padding: 20px 0 ;background-color: #6db6ff;width: fit-content;">
              <span class="fa fa-quote-left font-weight-bold"></span>
              <?php echo  $p->description ?>
              <span class="fa fa-quote-right float-right font-weight-bold"></span>
            </div>
            <div class=" text-center mb-3">
            </div>
            </div>
          </div>
          @endforeach
          <!-- AGENDA -->
          <div class="col-md-12 col-sm-12 col-lg-6 " style="background-color: #fff; margin-left:0px;">
              <div class="kalender"><a href="https://drive.google.com/file/d/1rUMM-b-_8X2p2n0aeDX4xppXygWhS-ed/view?usp=sharing" target="_blank">
              <img src="/storage/photos/1/PENGUMUMAN-PERUBAHAN PENDATAAN-NON-ASN.png" width="100%" height="100%" alt=""></a>
                <div></div>
              </div>

          </div>
        </div>
      </div>
    </section>
  </div>
<!-- KEPALA & AGENDA END  -->

 </main>
 </div>
  <!-- pengumuman -->
  <div class=" mb-12 " style="background-color: #1976d2;width: 100%;">
    <?php
    $agen=DB::table('labels')->where('lang',$bahasa)->where('kondisi','beritasel')->get();
    foreach($agen as $a){
      echo '<p style="position: absolute;font-size: 18px;font-family: Arial, Helvetica, sans-serif;color:white; "
      class=" ml-3 p-2 font-weight-bold ">'.$a->title.'
      </p>';
    }
    ?>
    <div style="background-color: #1976d2 ; padding: 10px; height: 6%">
  </div>
  </div>
  <!-- PENGUMUMAN END  -->

  <!-- BERITA START  -->
  @php
      $berita_lists=DB::table('posts')->where('lang',$bahasa)->where('status','active')->orderBy('id','DESC')->limit(3)->get();
  @endphp
  @foreach($berita_lists as $berita)
  <div class="news-data m-0 p-0">
    <div class="news" style="background-image: url({{$berita->photo}});background-size: 100%;">
      <div class="news-text">
        <a href="{{$berita->slug}}" class=" text-white d-block text-decoration-none mb-3" style="font-size:20px">{{$berita->title}}</a>
        <div class="d-flex justify-content-center mb-3 ml-auto mr-auto">
          <a href="{{$berita->slug}}" class="btn  btn-warning" style="margin-left: 0 !important;"><b>Selengkapnya</b></a>
        </div>
      </div>
    </div>
  </div>
  @endforeach
<!-- BERITA END  -->

<!-- TABS START  -->
  <section id="tabs">
    <div class="container">
      <?php
      $agen=DB::table('labels')->where('lang',$bahasa)->where('kondisi','informasi')->get();
      foreach($agen as $a){
        echo '<h6 class="section-title h4  font-weight-bold">'.$a->title.'</h6>';
      }
      ?>
      <div class="row">
        <div class="col-xs-12 ">
          <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              <a class="nav-link nav-item active" id="nav-pengumuman-tab" data-toggle="tab" href="#nav-pengumuman"
                role="tab" aria-controls="nav-pengumuman" aria-selected="true">
                <span class="fa fa-bullhorn" style="font-size: 75px;"></span><br><br>
                <?php
                $agen=DB::table('labels')->where('lang',$bahasa)->where('kondisi','pengumuman')->get();
                foreach($agen as $a){
                  echo '<span style="color: #1976d2;">'.$a->title.'</span>';
                }
                ?>
              </a>
              <a class="nav-link nav-item " id="nav-pers-tab" data-toggle="tab" href="#nav-pers" role="tab"
                aria-controls="nav-pers" aria-selected="true">
                <span class="fa fa-newspaper " style="font-size: 75px;"></span><br><br>
                <?php
                $agen=DB::table('post_categories')->where('lang',$bahasa)->where('kondisi','pers')->get();
                foreach($agen as $a){
                  echo '<span style="color: #1976d2;">'.$a->title.'</span>';
                }
                ?>
              </a>
              <a class="nav-link nav-item " id="nav-artikel-tab" data-toggle="tab" href="#nav-artikel" role="tab"
                aria-controls="nav-artikel" aria-selected="true">
                <span class="fa fa-globe-asia" style="font-size: 75px;"></span><br><br>
                <?php
                $agen=DB::table('post_categories')->where('lang',$bahasa)->where('kondisi','artikel')->get();
                foreach($agen as $a){
                  echo '<span style="color: #1976d2;">'.$a->title.'</span>';
                }
                ?>
              </a>
            </div>
          </nav>
          @php
          $pengumuman_lists=DB::table('pengumumen')->where('lang',$bahasa)->where('status','active')->orderBy('id','DESC')->limit(4)->get();
          @endphp
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-pengumuman" role="tabpanel"
              aria-labelledby="nav-pengumuman-tab">
              <div class="row row-cols-1 row-cols-md-4 border-0">
                @foreach($pengumuman_lists as $pengumuman)
                <div class="col text-center pl-2 pr-2 pb-0">
                  <div class="border-0  ">
                    <a href="{{$pengumuman->slug}}" class=" text-dark text-decoration-none">
                      <div class="card-body tabs-item ">
                        <p class="card-text tab-text">{{$pengumuman->title}} </p>
                      </div>
                    </a>

                  </div>
                </div>
                @endforeach
              </div>
            </div>
            @php
                $siaran_lists=DB::table('posts')->where('lang',$bahasa)->where('status','active')->where('post_cat_id','12')->orderBy('id','DESC')->limit(4)->get();
            @endphp
            <div class="tab-pane fade" id="nav-pers" role="tabpanel" aria-labelledby="nav-pers-tab">
              <div class="row row-cols-1 row-cols-md-4 border-0">
                @foreach($siaran_lists as $siaran)
                <div class="col text-center pl-2 pr-2 pb-0">
                  <div class="border-0  ">
                    <a href="{{$siaran->slug}}" class=" text-dark text-decoration-none">
                      <div class="card-body tabs-item ">
                        <p class="card-text tab-text">{{$siaran->title}} </p>
                      </div>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            @php
                $artikel_lists=DB::table('posts')->where('lang',$bahasa)->where('status','active')->where('post_cat_id','18')->orderBy('id','ASC')->limit(4)->get();
            @endphp
            <div class="tab-pane fade" id="nav-artikel" role="tabpanel" aria-labelledby="nav-artikel-tab">
              <div class="row row-cols-1 row-cols-md-4 border-0">
                @foreach($artikel_lists as $artikel)
                <div class="col text-center pl-2 pr-2 pb-0">
                  <div class="border-0  ">
                    <a href="{{$artikel->slug}}" class=" text-dark text-decoration-none">
                      <div class="card-body tabs-item ">
                        <p class="card-text tab-text">{{$artikel->title}} </p>
                      </div>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            @php
                $berita_unit_lists=DB::table('posts')->where('lang',$bahasa)->where('status','active')->where('post_cat_id','9')->orderBy('id','ASC')->limit(4)->get();
            @endphp
            <div class="tab-pane fade" id="nav-berita" role="tabpanel" aria-labelledby="nav-berita-tab">
              <div class="row row-cols-1 row-cols-md-4 border-0">
                @foreach($berita_unit_lists as $berita_unit)
                <div class="col text-center pl-2 pr-2 pb-0">
                  <div class="border-0  ">
                    <a href="{{$berita_unit->slug}}" class=" text-dark text-decoration-none">
                      <div class="card-body tabs-item ">
                        <p class="card-text tab-text">{{$berita_unit->title}} </p>
                      </div>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TABS END  -->

<!-- APLIKASI & LINK START  -->

  @php
      $aplikasi_lists=DB::table('aplikasis')->where('status','active')->orderBy('id','DESC')->limit(8)->get();
      $pengumuman_1=DB::table('links')->where('status','active')->orderBy('id','ASC')->limit(4)->get();
      $widget=DB::table('widgets')->where('status','active')->orderBy('id','ASC')->limit(4)->get();
      $kiri=DB::table('widgets')->where('status','active')->where('side','kiri')->orderBy('id','ASC')->get();
      $kanan=DB::table('widgets')->where('status','active')->where('side','kanan')->orderBy('id','ASC')->get();
  @endphp
  <div class=" container-fluid row-inline mt-5 mb-5">
    <div class="row no-gutter ">
      <div class="col-md-6 col-sm-12 col-lg-6 mb-3">
        <?php
        $agen=DB::table('labels')->where('lang',$bahasa)->where('kondisi','aplikasi')->get();
        foreach($agen as $a){
          echo '<h4 class=" font-weight-bold p-3">'.$a->title.'</h4>';
        }
        ?>
        <div class="align-middle text-center" >
          <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 border-0">
            @foreach($aplikasi_lists as $aplikasi)
            <div class="col  p-1">
              <div class="card border-0   bg-transparent" style="box-shadow: none !important;">
                <a href="{{$aplikasi->slug}}" class=" text-decoration-none text-dark btn btn-outline-dark"
                  style="border: 2px solid rgb(49, 49, 49);border-radius: 5px;" target="_blank" >
                  <img src="{{$aplikasi->photo}}" class="  text-center float-left " width="100%" height="auto"
                    style="border-radius: 5px;" alt="aplikasi"></img>
                </a>
              </div>
            </div>
            @endforeach
          </div>
        </div>

      </div>
      <!-- The part half -->
      <div class="col-md-6 col-sm-12 col-lg-6 announcement">
        <div class="announ-link  position-relative pl-3 pr-3" style=" border-left: 2px solid #cfcfcf;">
          @foreach($kanan as $row)
          <h4 class=" font-weight-bold p-3">BKKBN LINKS</h4>
          <div class="align-middle text-center">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 border-0">
              @foreach($pengumuman_1 as $pengumuman)
              <div class="col-lg-12 col-sm-12 col-md-12  p-1">
                <div class="card border-0   bg-transparent" style="box-shadow: none !important;">
                  <a href="{{$pengumuman->url}}" class=" text-decoration-none text-dark btn btn-outline-dark"
                    style="border: 2px solid rgb(49, 49, 49);border-radius: 5px;">
                    <img src="{{$pengumuman->photo}}" class="  text-center float-left " width="100%" height="auto"
                      style="border-radius: 5px;" alt="aplikasi"></img>

                  </a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
<!-- APLIKASI & LINK END  -->

<!-- WIDGETS START  -->
  @php
      $widget=DB::table('widgets')->where('status','active')->orderBy('id','ASC')->limit(4)->get();
      $kiri=DB::table('widgets')->where('status','active')->where('side','kiri')->orderBy('id','ASC')->get();
      $kanan=DB::table('widgets')->where('status','active')->where('side','kanan')->orderBy('id','ASC')->get();
  @endphp
  <div class=" container-fluid row-inline mt-5 mb-5">
    <div class="row no-gutter ">
      <div class="col-md-6 col-sm-12 col-lg-6 mb-3">
        @foreach($kiri as $row)
        <h4 class=" font-weight-bold p-3">{{ $row->title }}</h4>
        <div class="align-middle text-center" >
          {!! $row->embed !!}
        </div>
        @endforeach
      </div>
      <!-- The part half -->
      <div class="col-md-6 col-sm-12 col-lg-6 announcement">
        <div class="  position-relative pl-3 pr-3" style=" border-left: 2px solid #cfcfcf;">
          @foreach($kanan as $row)
          <h4 class=" font-weight-bold p-3">{{ $row->title }}</h4>
          <div class="align-middle text-center">
            {!! $row->embed !!}
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
<!-- WIDGET END  -->

@endsection
@php
      $settings=DB::table('settings')->get();
  @endphp
  @foreach($settings as $h)

  <title>{{$h->short_des}}</title>

  <link rel="shortcut icon" href="{{asset('storage/photos/1/Favicon/android-icon-96x96.png')}}">


  @endforeach
<link rel="manifest" href="{{ asset('frontend/js/manifest.json') }}">
  <script src="{{ asset('frontend/js/jquery-3.5.1.slim.min.js') }}"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script>
    if('serviceWorker' in navigator) {
        navigator.serviceWorker
            .register('/service-worker.js', { scope: '/' })
            .then(function(registration) {
                console.log('Service Worker Registered');
            });

        navigator.serviceWorker
            .ready
            .then(function(registration) {
                console.log('Service Worker Ready');
            });
    }
  </script>
  <script src="{{ asset('frontend/js/moment.min.js') }}"></script>
  <script src="{{ asset('frontend/js/calender.js') }}"></script>

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var data = [
    <?php foreach($agenda as $a){ ?>
      {eventName: '{{$a->title}}', calendar: 'Work', color: 'orange', eventTime: moment("{{$a->tanggal}}")},
          <?php } ?>
  ];
  var calendar = new Calendar('#inicalendar', data);
});
</script>



</html>
