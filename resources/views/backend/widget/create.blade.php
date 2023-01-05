@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Tambah Widget</h5>
    <div class="card-body">
      <form method="post" action="{{route('widget.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="Tag" class="col-form-label">Judul</label>
          <input id="Tag" type="text" name="title" placeholder="Masukkan Tag" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputbahasa" class="col-form-label">Embed</label>
          <input id="inputbahasa" type="text" name="embed" placeholder="Masukkan Bahasa" class="form-control">
          @error('embed')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="status" class="col-form-label">Side</label>
          <select name="side" class="form-control">
              <option value="kanan">Kanan</option>
              <option value="kiri">Kiri</option>
          </select>
          @error('status')
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
