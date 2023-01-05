@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Ubah Pages</h5>
    <div class="card-body">
      <form method="post" action="{{route('pages.update',$pages->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="lang">Bahasa</label>
          <select name="lang" class="form-control">
              <option value="">--Pilih Bahasa--</option>
              @foreach($lang as $key=>$b)
                <option value='{{$b->id}}' {{(($pages->lang==$b->id)? 'selected' : '')}}>{{$b->lang}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="title" class="col-form-label">Judul</label>
          <input id="title" type="text" name="title" placeholder="Masukkan Title"  value="{{$pages->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputtitle" class="col-form-label">Link <span class="text-danger">*</span></label>
          <input id="inputtitle" type="text" name="slug" placeholder="Masukkan link"  value="{{$pages->link}}" class="form-control">
          @error('slug')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">File <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Pilih
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="file" value="{{old('file')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('file')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="text" class="col-form-label">Text</label>
          <textarea class="form-control" id="text" name="text" value="{{$pages->text}}">{{$pages->text}}</textarea>
          @error('text')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status</label>
          <select name="status" class="form-control">
            <option value="active" {{(($pages->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($pages->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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
    $('#lfm').filemanager('file');
    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Ketik disini .....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#text').summernote({
        placeholder: "",
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
    // $('select').selectpicker();

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
