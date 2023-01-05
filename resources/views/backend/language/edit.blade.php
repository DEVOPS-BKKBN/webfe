@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Ubah Kategori Bahasa</h5>
    <div class="card-body">
      <form method="post" action="{{route('language.update',$language->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="Tag" class="col-form-label">Tag</label>
          <input id="Tag" type="text" name="tag" placeholder="Masukkan Tag"  value="{{$language->tag}}" class="form-control">
          @error('tag')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Bahasa</label>
          <input id="inputTitle" type="text" name="lang" placeholder="Masukkan Judul"  value="{{$language->lang}}" class="form-control">
          @error('lang')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status</label>
          <select name="status" class="form-control">
            <option value="active" {{(($language->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($language->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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
