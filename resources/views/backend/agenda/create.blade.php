@extends('backend.layouts.master')

@section('title','PORTAL-BKKBN || Agenda Create')

@section('main-content')

<div class="card">
    <h5 class="card-header">Tambah Agenda</h5>
    <div class="card-body">
      <form method="post" action="{{route('agenda.store')}}">
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
        @php
        $pejabats=DB::table('pejabats')->select('nama')->get();
        @endphp
        <div class="form-group">
            <label for="inputDesc" class="col-form-label">Pejabat <span class="text-danger">*</span></label>
            <select name="pejabat" class="form-control">
                <option value="">-----Pilih Pejabat-----</option>
                @foreach($pejabats as $pejabat)
                    <option value="{{$pejabat->nama}}">{{$pejabat->nama}}</option>
                @endforeach
            </select>
          @error('pejabat')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Nama Agenda <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Deskripsi</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
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
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTanggal" class="col-form-label">Tanggal <span class="text-danger">*</span></label>
          <input id="date" type="text" name="tanggal"  class="form-control" autocomplete="off">
          @error('tanggal')
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
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Ketik disini .....",
        tabsize: 2,
        height: 150
    });
    });
</script>
<script src="{{asset('backend/js/jquery-ui.js')}}"></script>
<script>
  $( function() {
    $( "#date" ).datepicker({
      dateFormat: "yy-m-dd"
    });
  } );
  </script>
@endpush
