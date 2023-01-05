@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Daftar Visitor</h6>
    </div>
    
    </div>
    <div class="card-body">
    <form method="post" action="{{route('log.store')}}">
        {{csrf_field()}}
        <div class="form-group">
        <label for="inputTanggal" class="col-form-label">Tanggal Mulai <span class="text-danger">*</span></label>
        <input id="date" type="text" name="start" class="form-control" autocomplete="off">
        @error('start')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
        <label for="inputTanggal" class="col-form-label">Tanggal Akhir <span class="text-danger">*</span></label>
        <input id="date2" type="text" name="end" class="form-control" autocomplete="off">
        @error('end')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Simpan</button>
        </div>
    </form>
      <div class="table-responsive">
        <table class="table table-bordered" id="post-category-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Login</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Login</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($visit as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->user}}</td>
                    <td>{{$data->login}}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$visit->links()}}</span>
      </div>
    </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script src="{{asset('backend/js/jquery-ui.js')}}"></script>
<script>
  $( function() {
    $( "#date" ).datepicker({
      dateFormat: "yy-m-d "
    });
  } );
  $( function() {
    $( "#date2" ).datepicker({
      dateFormat: "yy-m-d"
    });
  } );
  </script>
  <script>

      $('#post-category-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Apa anda yakin?",
                    text: "Jika di hapus, data ini tidak akan bisa dikembalikan lagi",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                      swal("Data tersimpan!");
                    }
                });
          })
      })
  </script>
@endpush
