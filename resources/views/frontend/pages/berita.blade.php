@extends('frontend.include.master')

@section('main-content')

    <main>
        <div id="content2">
            @foreach($post as $p)
                <h2>{{$p->title}}</h2>

                        <?php
                        $d = $p->added_by;
                        $catd=DB::table('users')->where('id',$d)->get();
                        ?>

                        {{$p->tanggal}}

                    </section>| <a id="category" href="" # style="text-decoration: none; color: black;">
                        <?php
                        $c = $p->post_cat_id;
                        $cat=DB::table('post_categories')->where('id',$c)->get();
                        ?>
                        @foreach($cat as $bn)
                        {{$bn->title}}</a>| <section id="respond" class=" d-inline">
                        @endforeach
                </p>
                <img src="{{$p->photo}} " alt="suhu" style=" width:100%">

                <div class="deskripsi" style="font-size:25px; font-weight:20px;">
                    
                        <?php echo $p->description; ?>
            @endforeach
                </div>
        </div>
        <aside>
            <article id="About">
                <h2>Berita Terkini</h2>
                <ul style="list-style:none" class="list-announ">
                    @php
                        $tar=DB::table('posts')->where('status','active')->where('lang',$bahasa)->orderBy('id','DESC')->limit(4)->get();
                    @endphp
                    @foreach($tar as $t)
                    <li>
                            <a href="{{$t->slug}}" target="_blank" title="">
                            <div class="list-news">{{$t->title}}</div>
                            </a>
                    </li>
                    <br></br>
                    @endforeach
                </ul>
            </article>
        </aside>
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
