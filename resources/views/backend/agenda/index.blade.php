@extends('backend.layouts.master')
@section('title','PORTAL-BKKBN || Agenda Page')
@section('main-content')
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Daftar Agenda</h6>
      <a href="{{route('agenda.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Tambah Agenda</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($agendas)>0)
        <table class="table table-bordered" id="agenda-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Bahasa</th>
              <th>Pejabat</th>
              <th>Nama Agenda</th>
              <th>Deskripsi</th>
              <th>Foto</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Bahasa</th>
              <th>Pejabat</th>
              <th>Nama Agenda</th>
              <th>Deskripsi</th>
              <th>Foto</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Aksi</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($agendas as $agenda)
                <tr>
                    <td>{{$agenda->id}}</td>
                    <td>
                      @php 
                      $bahasa=DB::table('languages')->select('lang')->where('id',$agenda->lang)->get();
                      @endphp
                      @foreach($bahasa as $b)
                          {{$b->lang}}
                      @endforeach
                    </td>
                    <td>{{$agenda->pejabat}}</td>
                    <td>{{$agenda->title}}</td>                  
                    <td>{{$agenda->description}}</td>
                    <td>
                        @if($agenda->photo)
                            <img src="{{$agenda->photo}}" class="img-fluid zoom" style="max-width:80px" alt="{{$agenda->photo}}">
                        @else
                            <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                        @endif
                    </td>
                    <td>{{$agenda->tanggal}}</td>
                    <td>
                        @if($agenda->status=='active')
                            <span class="badge badge-success">{{$agenda->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$agenda->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('agenda.edit',$agenda->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('agenda.destroy',[$agenda->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$agenda->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    {{-- Delete Modal --}}
                    {{-- <div class="modal fade" id="delModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$user->id}}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="#delModal{{$user->id}}Label">Delete user</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="{{ route('agendas.destroy',$user->id) }}">
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
        <span style="float:right">{{$agendas->links()}}</span>
        @else
          <h6 class="text-center">No agendas found!!! Please create agenda</h6>
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
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(3.2);
      }
  </style>
@endpush

@push('scripts')
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#agenda-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
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
