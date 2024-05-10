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
						<li class="breadcrumb-item active"><a href="#">BLOGS</a></li>
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
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>  
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
var btnRoute = '{{route('edit_blog')}}';
var deletebtn = '{{route('delete_blog')}}';
       $(document).ready(function(){

          // DataTable
          $('#hotelsTable').DataTable({
             aLengthMenu: [
                [50, 100, 250,500, -1],
                [50, 100, 250,500, "All"]
            ],
            iDisplayLength: 50,
            language: { search: '', searchPlaceholder: "Search..." },
             processing: true,
             serverSide: true,
             ajax: "{{route('list_blogs')}}",
             columns: [

             { data: 'thumbnail_image',render: function (data, type, row, meta) {

                return '<img  style="border-radius:0px; width:"80px ; height: 80px" src="' + data + '" height="80px" width="80px"/>';
              }
            },       


                // {data: 'image'},
                // { data: 'id' },
                { data: 'id' },
                { data: 'title' },
                { data: 'short_description' },
                { data: 'ispublished' },
                {data: 'id', render:function(data,type,row,meta){
              return '<a href="'+btnRoute+'/'+data+'">Edit</a> | <a href="'+deletebtn+'/'+data+'" onclick="return confirm(\'Are you sure?\')">Delete</a> '
            }
          }
             ]
          });
        });





</script>

@endpush
