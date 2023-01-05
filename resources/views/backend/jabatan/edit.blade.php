@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Ubah Jabatan</h5>
    <div class="card-body">
      <form method="post" action="{{route('jabatan.update',$jabatan->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Kode Jabatan <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="code" placeholder="Masukkan Kode Jabatan"  value="{{$jabatan->code}}" class="form-control">
          @error('code')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($jabatan->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($jabatan->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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
