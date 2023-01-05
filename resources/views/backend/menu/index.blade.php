@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    @php 
    $lang=DB::table('languages')->where('status','active')->get();
    @endphp
    <div class=" ml-auto text-white p-2 mr-4 pb-0" style=" font-size: 16px">
        @php 
        $k = 1;
        @endphp
        @foreach($lang as $ba)
          @php
          if($k % 2 == 0){
          @endphp
            <a>|</a>
          @php
          }
          $k++;
          @endphp
          <a href="{{route('menu.show',$ba->id)}}">{{$ba->lang}}</a>
          @endforeach
        </div>
    
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Daftar Menu</h6>
      <a href="{{route('menu.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Tambah Menu</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($menu)>0)
        <table class="table table-bordered" id="post-category-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Bahasa</th>
              <th>Parent_ID</th>
              <th>Judul</th>
              <th>Link</th>
              <th>Class</th>
              <th>Posisi</th>
              <th>Group_ID</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Bahasa</th>
              <th>Parent_ID</th>
              <th>Judul</th>
              <th>Link</th>
              <th>Class</th>
              <th>Posisi</th>
              <th>Group_ID</th>
              <th>Status</th>
              <th>Aksi</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($menu as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>
                      @php 
                      $bahasa=DB::table('languages')->select('lang')->where('id',$data->lang)->get();
                      @endphp
                      @foreach($bahasa as $b)
                          {{$b->lang}}
                      @endforeach
                    </td>
                    <td>{{$data->parent_id}}</td>
                    <td>{{$data->title}}</td>
                    <td>{{$data->url}}</td>
                    <td>{{$data->class}}</td>
                    <td>{{$data->position}}</td>
                    <td>{{$data->group_id}}</td>
                    <td>
                        @if($data->active=='Y')
                            <span class="badge badge-success">{{$data->active}}</span>
                        @else
                            <span class="badge badge-warning">{{$data->active}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('menu.edit',$data->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('menu.destroy',[$data->id])}}">
                      @csrf
                      @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id={{$data->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    {{-- Delete Modal --}}
                    {{-- <div class="modal fade" id="delModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$data->id}}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="#delModal{{$data->id}}Label">Delete user</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="{{ route('menu.destroy',$data->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" style="margin:auto; text-align:center">Parmanent delete user</button>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div> --}}
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$menu->links()}}</span>
        @else
          <h6 class="text-center">No menu found!!! Please create menu</h6>
        @endif
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
