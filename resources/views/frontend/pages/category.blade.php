@extends('frontend.include.master')

@section('main-content')

    <main>
        <div id="content2">
          @foreach($posts as $post)

		<div style="height:20%; margin-bottom:30px;">
                  <img src="{{$post->photo}}" class="float-left ml-5 mr-3 position-relative" width="20%"
                    height="100%" alt="">
            <div class="mt-4 position-relative text-black" style="max-width: 70%;margin-left: 280px;">
                      <a href="{{$post->slug}}" class="h5 text-decoration-none">{{$post->title}}</a>
                      <p style="font-size: 15px; " class=" text-black-50">Waktu Publikasi: 
                        {{ Carbon::parse($post->created_at)->translatedFormat('d F Y') }}</p>
                      <p align="justify"><?php echo \Illuminate\Support\Str::limit(strip_tags($post->description), 200, $end='...') ?>
                      <a href="{{$post->slug}}" class=" font-weight-bold text-warning position-relative "
                        style="margin-left: auto;margin-right: auto;">Baca
                        Selengkapnya</a>
            </div>
        </div>
                </br>
          @endforeach
          {!! $posts->links() !!}
        </div>
    </main>
    @endsection
@php
      $settings=DB::table('settings')->get();
  @endphp
@foreach($settings as $h)

  <title>{{$h->short_des}}</title>

  <link rel="shortcut icon" href="{{$h->favicon}}">


  @endforeach
</html>
