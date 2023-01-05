@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Ubah Berita</h5>
    <div class="card-body">
      <form method="post" action="{{route('pengumuman.update',$post->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="lang">Bahasa</label>
          <select name="lang" class="form-control" required>
              <option value="">--Pilih Bahasa--</option>
              @foreach($lang as $key=>$b)
                <option value='{{$b->id}}' {{(($post->lang==$b->id)? 'selected' : '')}}>{{$b->lang}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Judul <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Masukkan Judul"  value="{{$post->title}}" class="form-control" required>
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Link <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="link" placeholder="Masukkan Link"  value="{{$post->link}}" class="form-control">
          @error('link') 
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTanggal" class="col-form-label">Tanggal <span class="text-danger">*</span></label>
          <input id="date" type="text" name="tanggal" placeholder="{{$post->tanggal}}" value="{{$post->tanggal}}" class="form-control" autocomplete="off" required>
          @error('tanggal')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Deskripsi FIle <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="desfile" placeholder="Masukkan Judul"  value="{{$post->desfile}}" class="form-control">
          @error('desfile')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">File <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm1" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Pilih
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="file" value="{{$post->file}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

          @error('file')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Foto <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Pilih
                  </a>
              </span>
          <input id="thumbnail2" class="form-control" type="text" name="photo" value="{{$post->photo}}" required>
        </div>
        <div id="holder2" style="margin-top:15px;max-height:100px;"></div>

          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control" required>
            <option value="active" {{(($post->status=='active')? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($post->status=='inactive')? 'selected' : '')}}>Inactive</option>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');
    $('#lfm1').filemanager('image');
    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Ketik disini ....",
        tabsize: 2,
        height: 150
    });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Ketik disini ....",
          tabsize: 2,
          height: 100
      });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Ketik disini ....",
          tabsize: 2,
          height: 150
      });
    });
</script>
<script src="{{asset('backend/js/jquery-ui.js')}}"></script>
<script>
  $( function() {
    $( "#date" ).datepicker({
      dateFormat: "d MM yy"
    });
  } );
  </script>
@endpush