@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Tambah Kategori Berita</h5>
    <div class="card-body">
      <form method="post" action="{{route('post-category.store')}}">
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
          <label for="inputTitle" class="col-form-label">Judul</label>
          <input id="inputTitle" type="text" name="title" placeholder="Masukkan Judul"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status</label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
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
