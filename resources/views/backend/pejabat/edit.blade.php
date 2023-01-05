@extends('backend.layouts.master')
@section('title','PORTAL-BKKBN || Pejabat Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Pejabat</h5>
    <div class="card-body">
      <form method="post" action="{{route('pejabat.update',$pejabat->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="lang">Bahasa</label>
          <select name="lang" class="form-control">
              <option value="">--Pilih Bahasa--</option>
              @foreach($lang as $key=>$b)
                <option value='{{$b->id}}' {{(($pejabat->lang==$b->id)? 'selected' : '')}}>{{$b->lang}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Nama <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="nama" placeholder="Enter nama"  value="{{$pejabat->nama}}" class="form-control">
        @error('nama')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Deskripsi</label>
          <textarea class="form-control" id="description" name="description">{{$pejabat->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        @php
        $jabatans=DB::table('jabatans')->select('code')->get();
        @endphp
          <div class="form-group">
            <label for="jabatan" class="col-form-label">Jabatan</label>
            <select name="jabatan" class="form-control">
              <option value="{{$pejabat->jabatan}}">{{$pejabat->jabatan}}</option>
                @foreach($jabatans as $jabatan)
                    <option value="{{$jabatan->code}}">{{$jabatan->code}}</option>
                @endforeach
            </select>
          @error('jabatan')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Foto <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Pilih
                </a>
            </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$pejabat->photo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($pejabat->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($pejabat->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Ketik disini ....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush
