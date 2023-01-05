<!DOCTYPE html>
<html >

@include('frontend.include.head')

<!-- <body id="page-top"> -->
<link rel="manifest" href="./frontend/js/manifest.json">
<body>
<div style="position:fixed;right:10px;bottom:20px;z-index:9;float:right;">
  <a href="https://api.whatsapp.com/send?phone=+628123456789&text=Halo">
  <button style="background:transparant;float:right;width:50px;height:50px;border-radius:5px">
  <img src="./frontend/images/wa.png" width="100%" height="100%" alt="wa"></button></a>
  </div>
  <!-- Page Wrapper -->
  <!-- <div id="wrapper"> -->
  <?php
      // foreach($ba as $b){
      //   $bahasa = $b->id;
      // }
      //$set=DB::table('settings')->where('lang',$bahasa)->get();
      //$lang = DB::table('languages')->where('status','active')->get();
  ?>

    <!-- Content Wrapper -->
    <!-- <div id="content-wrapper" class="d-flex flex-column"> -->

      <!-- Main Content -->
      <!-- <div id="content"> -->

        <!-- Topbar -->
        <!--  -->
        @include('frontend.include.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('main-content')
        <!-- /.container-fluid -->

      <!-- </div> -->
      <!-- End of Main Content -->
      @include('frontend.include.footer')

</body>

@php $set = DB::table('settings')->select('*')->get(); @endphp
</html>
@foreach($set as $h)

  <title>{{$h->short_des}}</title>

  <link rel="shortcut icon" href="{{$h->favicon}}">
  <!--<link rel="shortcut icon" href="{{asset('storage/photos/1/Favicon/android-icon-96x96.png')}}">-->


  @endforeach
