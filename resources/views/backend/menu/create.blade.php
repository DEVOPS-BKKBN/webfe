@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Tambah Menu</h5>
    <div class="card-body">
      <form method="post" action="{{route('menu.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="lang">Bahasa</label>
          <select name="lang" class="form-control">
              <option value="">--Pilih Bahasa--</option>
              @foreach($lang as $key=>$b)
                <option value='{{$b->id}}' {{($key=0) ? 'selected' : ''}}>{{$b->lang}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="parent_id">Induk</label>
          <select name="parent_id" class="form-control">
              <option value="">--Pilih Induk--</option>
              <option value="0">Induk</option>
              @foreach($menu as $key=>$b)
                <option value='{{$b->id}}' {{($key=0) ? 'selected' : ''}}>{{$b->title}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="Title" class="col-form-label">Judul</label>
          <input id="Tit;e" type="text" name="title" placeholder="Masukkan Judul" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="lang">Halaman</label>
          <select name="url" class="form-control">
              <option value="#">--Pilih Halaman--</option>
              @foreach($pages as $key=>$b)
                <option value='{{$b->id}}' {{(($key=0)? 'selected' : '')}}>{{$b->title}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="class" class="col-form-label">Class</label>
          <input id="class" type="text" name="class" placeholder="Masukkan Class" class="form-control">
          @error('class')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="position" class="col-form-label">Urutan</label>
          <input id="position" type="text" name="position" placeholder="Masukkan Urutan" class="form-control">
          @error('position')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="group" class="col-form-label">Menu Akses</label>
          <select name="group_id" class="form-control">
              <option value="1">Admin</option>
              <option value="3">Contributor</option>
              <option value="2">Frontend</option>
          </select>
          @error('group_id')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="target" class="col-form-label">Target</label>
          <select name="target" class="form-control">
              <option value="_blank">_blank</option>
              <option value="none">none</option>
          </select>
          @error('target')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="active" class="col-form-label">Status</label>
          <select name="active" class="form-control">
              <option value="Y">Y</option>
              <option value="N">N</option>
          </select>
          @error('active')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Simpan</button>
        </div>
      </form>
    </div>
</div>

@endsection
