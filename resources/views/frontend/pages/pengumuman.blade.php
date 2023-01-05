@extends('frontend.include.master')

@section('main-content')

    <main>
        <div id="content2">
                <table>
                @foreach($post as $p)
                    <tr background-color="#ccc">
                        <td width="30px">Judul</td>
                        <td >:</td>
                        <td>{{$p->title}}</td>
                    </tr>
                    <tr >
                        <td width="30px">Tanggal</td>
                        <td width="5px">:</td>
                        <td>{{$p->tanggal}}</td>
                    </tr>
                    <tr background-color="#ccc">
                        <td width="30px">Link</td>
                        <td >:</td>
                        <td><a href="{{$p->link}}">{{$p->link}}</a></td>
                    </tr>
                    <tr>
                        <td width="30px">File</td>
                        <td>:</td>
                        <td><?php 
                    if($p->file != ""){
                    echo '<a href="'.$p->file.'" class="pengbut">Unduh</a>';
                    }
                ?>
                @endforeach</td>
                    </tr>
                </table>
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
