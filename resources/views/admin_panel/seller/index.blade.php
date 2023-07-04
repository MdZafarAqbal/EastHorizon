@extends('admin_panel.layouts.master')
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="row">
      <div class="col-md-12">
        @include('admin_panel.layouts.notification')
      </div>
    </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Product buying List</h6>
      <a href="{{route('buying.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add buying Details</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($buyings)>0)
          <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Email Id</th>
                <th>Product Name</th>
                <th>Serial No</th>
                <th>IMEI No</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
            <tr>
            <th>S.N.</th>
                <th>buying Name</th>
                <th>Mobile No</th>
                <th>Email Id</th>
                <th>Product Name</th>
                <th>Serial No</th>
                <th>IMEI No</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
               
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>

              @foreach($buyings as $buying)
                <tr>
                  <td>{{$buying->id}}</td>
                  <td>{{$buying->buying_name}}</td>
                  <td>{{$buying->mobile_name}}</td>
                  <td>{{$buying->email_id}}</td>
                  <td>{{$buying->product_name}}</td>                 
                  <td>{{$buying->serial_no}}</td>
                  <td>{{$buying->imei_no}}</td>
                  <td>{{$buying->qty}}</td>                 
                  <td>{{$buying->price}}</td>
                  <td>{{$buying->total}}</td>
                  
                  <td>
                      <a href="{{route('buying.edit',$buying->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="{{route('buying.destroy',[$buying->id])}}">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id="{{$buying->id}}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </tr>                     
                </tr>
              @endforeach
            </tbody>
          </table>
          {!! $buyings->withQueryString()->links('pagination::bootstrap-5') !!}
          
        @else
          <h6 class="text-center">No product found!!! </h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('admin_panel/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('admin_panel/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin_panel/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('admin_panel/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#banner-dataTable').DataTable( {
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
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
@endpush
