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
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
	{{session('success')}}
</div>
@endif

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="#">PACKAGES</a></li>
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
                        <th></th>                        
                        {{-- <th>ID</th> --}}
                        <th>Title</th>
                        <th>Category</th>
                        {{-- <th>Description</th> --}}
                        <th>Price</th>
                        {{-- <th>City</th> --}}
                        <th>Country</th>
                        {{-- <th>Status</th>   --}}
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
var btnRoute = '{{route('edit_package')}}';
var deletebtn = '{{route('delete_package')}}';
       $(document).ready(function(){

          // DataTable
          $('#hotelsTable').DataTable({
            order: [[ 1, "desc" ]],
             aLengthMenu: [
                [50, 100, 250,500, -1],
                [50, 100, 250,500, "All"]
            ],
            iDisplayLength: 50,
            language: { search: '', searchPlaceholder: "Search..." },
             processing: true,
             serverSide: true,
             ajax: "{{route('list_packages')}}",
             columns: [

             { width: "10%", data: 'thumbnail_image',render: function (data, type, row, meta) {

                return '<img  style="border-radius:0px; width:"80px ; height: 80px" src="' + data + '" height="80px" width="80px"/>';
              }
            },       


                // {data: 'image'},
                // { data: 'id' },
                // { data: 'id' },
                { width: "15%", data: 'title' },
                {  width: "10%",data: 'category' },
                // { data: 'short_description' },
                {  width: "10%",data: 'package_price' },
                // { data: 'city' },
                {  width: "10%", data: 'country' },
                // { data: 'is_active' },
                { width: "15%",data: 'id', render:function(data,type,row,meta){
              return '<a href="'+btnRoute+'/'+data+'">Edit</a> | <a href="'+deletebtn+'/'+data+'" onclick="return confirm(\'Are you sure?\')">Delete</a> '
            }
          }
             ]
          });
        });





</script>

@endpush
