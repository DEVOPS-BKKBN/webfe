@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Ubah Kategori Bahasa</h5>
    <div class="card-body">
      <form method="post" action="{{route('widget.update',$widget->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="Tag" class="col-form-label">title</label>
          <input id="Tag" type="text" name="title" placeholder="Masukkan Tag"  value="{{$widget->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Embed</label>
          <input id="inputTitle" type="text" name="embed" placeholder="Masukkan Judul"  value="{{$widget->embed}}" class="form-control">
          @error('embed')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="status" class="col-form-label">Side</label>
          <select name="side" class="form-control">
            <option value="kanan" {{(($widget->side=='kanan') ? 'selected' : '')}}>Kanan</option>
            <option value="kiri" {{(($widget->side=='kiri') ? 'selected' : '')}}>Kiri</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="status" class="col-form-label">Status</label>
          <select name="status" class="form-control">
            <option value="active" {{(($widget->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($widget->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Perbaharui</button>
        </div>
      </form>
    </div>
</div>

@endsection
