<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
      <div class="sidebar-brand-icon "height="60px" weight="60px">
        <img class="img-profile" src="{{asset('storage/photos/1/Login/logo.png')}}" height="30" weight="30">
      </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <?php
    $grup = 1;
    if(Auth()->user()->role == 'contributor'){
      $grup = 3;
    }
    $menu = \App\Models\Menu::where('group_id',$grup)->where('active','Y')->get();

    foreach($menu as $m){
      if($m->parent_id == '0'){
        $main = $m->id;
        $child = "NO";
        foreach($menu as $b){
          if($b->parent_id == $main){
            $child = "YES";
          }
        }
        if($child == "YES"){?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#{{$m->title}}" aria-expanded="true" aria-controls="collapseTwo">

            <i class="fas fa-fw {{$m->class}}"></i>
            <span>{{$m->title}}</span>
          </a>
          <div id="{{$m->title}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{$m->title}} Options:</h6>
                @foreach($menu as $b)
                  <?php
                  if($b->parent_id == $main){
                    $sub = $b->id;
                  ?>

                  <a class="collapse-item" href="/admin/{{$b->url}}">{{$b->title}}</a>
                  <?php
                  }
                  ?>
                @endforeach
              </div>
          </div>
        <?php
        }
        else{?>
          <li class="nav-item">

            <a class="nav-link" href="/{{Auth()->user()->role}}/{{$m->url}}">
                <i class="fas {{$m->class}}"></i>
                <span>{{$m->title}}</span></a>
        <?php
        }
        ?>
          </li>
      <?php
      }
    }
    ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
