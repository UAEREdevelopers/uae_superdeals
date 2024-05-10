@extends('backend.layout.index')

@section('content')

<div class="page-content">
    
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
	{{session('success')}}
 </div>
 @endif
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="text-align-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createcategory">Create </button>
                    </div>
                   
                    <table class="table">
                        <thead>
                            <th>Category</th>
                            <th>Parent Category</th>
                            <th></th>
                        </thead>
                        <tbody>
                             @forelse($categories as $category)
                            <tr>
                               
                                <td>{{$category->name}} </td>
                                <td>{{$category->category->name ?? ''}} </td>
                                <td><a href="#" onclick="editcategory('{{$category->id}}','{{$category->name}}','{{$category->category_id}}','{{$category->image}}','{{$category->banner}}','{{$category->link}}')" >Edit</a> | <a href="{{route('admin_delete_category', ['id'=> $category->id])}}">Delete</a></td>
                            </tr>
                            @empty 
                            <p>No Categories yet </p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>           
       
    </div>


    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="createcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin_save_category')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">           
            <input type="text" class="form-control" autocomplete="off" name="category" placeholder="Category Title">
        </div>

        <div class="form-group">           
            <input type="text" class="form-control" autocomplete="off" name="link" id="" placeholder="Link">
        </div>

        <div class="form-group">
            <select class="form-control" name="parent_id">
                <option selected="" disabled="">Parent Category</option>
                <option value="0">Main Menu</option>
               @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
               @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (400 x267 px)" required>
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label>Banner</label>
            <input type="file" name="banner" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (1600 x 800 px)" required>
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
            </div>
        </div>


        <button class="btn btn-primary text-center pull-right" type="submit">Save</button>

        </form>
      </div>
     
    </div>
  </div>
</div>

{{-- Update modal --}}

<div class="modal fade" id="updatecategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin_update_category')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="categoryid" id="categoryid">
        <div class="form-group">           
            <input type="text" class="form-control" autocomplete="off" name="category" id="categoryname" placeholder="Category Title">
        </div>

        <div class="form-group" id="categoryparent">
            <select class="form-control" name="parent_id" >
                <option selected="" >Parent Category</option>
                <option value="0">Main Menu</option>
               @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
               @endforeach
            </select>
        </div>

        <div class="form-group">           
            <input type="text" class="form-control" autocomplete="off" name="link" id="categorylink" placeholder="Link">
        </div>

        <div class="form-group">
           <img src="" alt="" width="150px" height="auto" id="categoryimage">
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (400 x267 px)" required>
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
            </div>
        </div>

        <div class="form-group">
           <img src="" alt="" width="150px" height="auto" id="bannerimage">
        </div>

        <div class="form-group">
            <label>Banner</label>
            <input type="file" name="banner" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (1600 x 800 px)" required>
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
            </div>
        </div>

        <button class="btn btn-primary text-center pull-right" type="submit">Update</button>

        </form>
      </div>
     
    </div>
  </div>
</div>

@endsection


{{-- Custom scripts for current page --}}
@push('scripts')
<script src="{{asset('backend/assets/js/file-upload.js')}}"></script>

<script>
    function editcategory(id, name , parent_id, image=null,banner=null, link=null)
    {
        $('#categoryid').val(id);
        $('#categoryname').val(name);
        $('#categorylink').val(link);
        $("#categoryimage").attr("src",image);
        $("#bannerimage").attr("src",banner);
        $("#categoryparent select").val(parent_id);

        $('#updatecategory').modal('show');
    }
</script>
@endpush
