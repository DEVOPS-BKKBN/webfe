@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Tambah Menu</h5>
    <div class="card-body">
      <form method="post" action="{{route('menu.update',$menu->id)}}">
      @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="lang">Bahasa</label>
          <select name="lang" class="form-control">
              <option value="">--Pilih Bahasa--</option>
              @foreach($lang as $key=>$b)
                <option value='{{$b->id}}' {{(($menu->lang==$b->tag)? 'selected' : '')}}>{{$b->lang}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="parent_id">Induk</label>
          <select name="parent_id" class="form-control" required>
              <option value="">--Pilih Induk--</option>
              <?php if($menu->parent_id == '0'){?>
                <option value="{{$menu->parent_id}}" {{(($menu->parent_id=='N') ? 'selected' : '')}}>Induk</option>
              <?php }else{?>
                <option value="0">Induk</option>
              <?php
              }
              ?>
              @foreach($par as $key=>$b)
              <option value="{{$b->id}}" {{(($menu->parent_id==$b->id) ? 'selected' : '')}}>{{$b->title}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="Title" class="col-form-label">Judul</label>
          <input id="Tit;e" type="text" name="title" value="{{$menu->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="lang">Halaman</label>
          <select name="url" class="form-control">
              <option value="#">--Pilih Halaman--</option>
              @foreach($pages as $key=>$b)
                <option value='{{$b->id}}' {{(($menu->url==$b->id)? 'selected' : '')}}>{{$b->title}}</option>
              @endforeach
          </select>
        </div>
        <!--<div class="form-group">
          <label for="url" class="col-form-label">Link</label>
          <input id="url" type="text" name="url" value="{{$menu->url}}" class="form-control">
          @error('url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>-->
        <div class="form-group">
          <label for="class" class="col-form-label">Class</label>
          <input id="class" type="text" name="class" value="{{$menu->class}}" class="form-control">
          @error('class')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="position" class="col-form-label">Urutan</label>
          <input id="position" type="text" name="position" value="{{$menu->position}}" class="form-control">
          @error('position')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="group" class="col-form-label">Menu Akses</label>
          <select name="group_id" class="form-control">
          <option value="1" {{(($menu->group_id=='1') ? 'selected' : '')}}>Admin</option>
          <option value="3" {{(($menu->group_id=='3') ? 'selected' : '')}}>Contributor</option>
          <option value="2" {{(($menu->group_id=='2') ? 'selected' : '')}}>Frontend</option>
          </select>
          @error('group_id')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="target" class="col-form-label">Target</label>
          <select name="target" class="form-control">
          <option value="_blank" {{(($menu->target=='_blank') ? 'selected' : '')}}>_blank</option>
            <option value="none" {{(($menu->target=='none') ? 'selected' : '')}}>none</option>
          </select>
          @error('target')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="active" class="col-form-label">Status</label>
          <select name="active" class="form-control">
          <option value="Y" {{(($menu->active=='Y') ? 'selected' : '')}}>Y</option>
            <option value="N" {{(($menu->active=='N') ? 'selected' : '')}}>N</option>
          </select>
          @error('active')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Kirim</button>
        </div>
      </form>
    </div>
</div>

@endsection
