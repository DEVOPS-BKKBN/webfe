@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Tambah Pages</h5>
    <div class="card-body">
      <form method="post" action="{{route('pages.store')}}">
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
          <label for="inputtitle" class="col-form-label">Judul <span class="text-danger">*</span></label>
          <input id="inputtitle" type="text" name="title" placeholder="Masukkan Judul"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">File <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Pilih
                  </a>
              </span>
          <input id="thumbnail1" class="form-control" type="text" name="file" >
        </div>
        <div id="holder1" style="margin-top:15px;max-height:100px;"></div>

          @error('file')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="text" class="col-form-label">Text</label>
          <textarea class="form-control" id="summernote" name="text">{{old('text')}}</textarea>
          @error('text')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
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

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css">


<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/github.min.css">


<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css">


<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

@endpush
@push('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>

// plugin
<script src="{{ asset('backend/uploadcare-widget/uploadcare.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('backend/summernote/summernote-bs4.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
     $(function() {
       $('#summernote').summernote({
         // unfortunately you can only rewrite
         // all the toolbar contents, on the bright side
         // you can place uploadcare button wherever you want
         toolbar: [
           ['uploadcare', ['uploadcare']], // here, for example
           ['style', ['style']],
           ['font', ['bold', 'italic', 'underline', 'clear']],
           ['fontname', ['fontname']],
           ['color', ['color']],
           ['para', ['ul', 'ol', 'paragraph']],
           ['height', ['height']],
           ['table', ['table']],
           ['insert', ['media', 'link', 'hr', 'picture', 'video']],
           ['view', ['fullscreen', 'codeview']],
           ['help', ['help']]
         ],
         uploadcare: {
           // button name (default is Uploadcare)
           buttonLabel: 'Image / file',
           // font-awesome icon name (you need to include font awesome on the page)
           buttonIcon: 'picture-o',
           // text which will be shown in button tooltip
           tooltipText: 'Upload files or video or something',

           // uploadcare widget options, see https://uploadcare.com/documentation/widget/#configuration
           publicKey: 'demopublickey', // set your API key
           crop: 'free',
           tabs: 'all',
           multiple: true
         }
       });
     });
   </script>
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
         $('#description').summernote({
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
       // $('select').selectpicker();

   </script>
@endpush
