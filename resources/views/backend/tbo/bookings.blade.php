@extends('backend.layout.index')

@section('styles')

<style>

  #hotelsTable_filter{
    text-align: right;
  }
</style>

@endseciton


@section('content')

<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">TBO</a></li>
						<li class="breadcrumb-item active" aria-current="page">BOOKINGS</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title"></h6>
                <p class="card-description"></p>
                <div class="table-responsive">
                  <table id="hotelsTable" class="table" width='100%'>
                    <thead>
                      <tr>
                          <th>Id</th>                   
                        <th>Confirmation No</th>
                        <th>Status</th>
                        <th>Booking Details</th>
                        <th>Dates</th>
                        <th>Price</th>
                        <th></th>
                      </tr>
                    </thead>                   
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>

			</div>

@endsection


{{-- Custom scripts for current page --}}
@push('scripts')

  <script src="{{asset('backend/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('backend/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>

<script>
var btnRoute = '{{route("edit_tbo_hotel_booking")}}';
       $(document).ready(function(){

          // DataTable
          $('#hotelsTable').DataTable({
              "order": [[ 0, "desc" ]],
             aLengthMenu: [
                [ 100, 250,500, -1],
                [ 100, 250,500, "All"]
            ],
            iDisplayLength: 100,
            language: { search: '', searchPlaceholder: "Search..." },
             processing: true,
             serverSide: true,
             ajax: "{{route('get_tbo_hotel_bookings')}}",
             columns: [ 
                { data: 'id' },  
                { data: 'confirmationNo' },
                { data: 'status' },
                { data: 'details' },
                { data: 'dates' },
                { data: 'price' },
                {data: 'id', render:function(data,type,row,meta){
              return '<a href="'+btnRoute+'/'+data+'">Edit</a>'
            }
          }
             ]
          });
        });





</script>

@endpush
