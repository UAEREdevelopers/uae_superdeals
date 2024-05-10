@extends('backend.layout.index')
@section('styles')

<style>
    .mce-label.mce-charactercount{
         margin: 2px 0 2px 2px;
  padding: 8px;
  font-size: 12px;
    }
 

.mce-path{
display: none !important;
}
  
</style>

<link rel="stylesheet" href="{{asset('backend/assets/vendors/dropzone/dropzone.min.css')}}">
@endsection
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
               <h6 class="card-title">Create Package</h6>
               <form action="{{route('save_blog')}}" method="POST" enctype="multipart/form-data">
                @csrf

                  <div class="row">
                     <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                           <label class="control-label">Title</label>
                           <input type="text" class="form-control" name="title"> 
                        </div>
                          <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="ispublished" id="optionsRadios5" value="1">
                                Publish
                            <i class="input-frame"></i></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="ispublished" id="optionsRadios6" value="0">
                                Draft
                            <i class="input-frame"></i></label>
                        </div>
                        
                    </div>

                        <div class="form-group">
                        <label>Banner image</label>
                        <input type="file" name="bannerimage" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (1600 x 1067 px)" required>
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Thumbnail image</label>
                        <input type="file" name="thumbnail" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (400 x267 px)" required>
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                        
                     </div>
                     <!-- Col -->
                     <div class="col-sm-8 col-md-8">
                        <div class="form-group">
                           <label class="control-label">Short Description</label>
                           {{-- blogdescription --}}
                           <textarea type="text" class="form-control ckeditor" name="short_description" id="" rows="5"  maxlength="150"></textarea>
                        </div>
                        <div class="form-group">
                           <label class="control-label">Description</label>
                           <textarea type="text" class="ckeditor form-control" name="description" id="descriptionccc" rows="5"  ></textarea>
                        </div>
                     </div>
                     <!-- Col -->
                  </div>
                  <!-- Row -->
            
               <button type="submit" class="btn btn-primary submit">create</button>
                  </form>
            </div>
         </div>
      </div>
   </div>
  
    <div class="row pb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">upload images</h6>								
                            <form action="{{route('upload_hotel_image')}}" class="dropzone" id="packageimageupload">
                                @csrf
                            <input type="hidden" name="packageid" id="" value="{{$blog_id}}">
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
  
@endsection
@push('scripts')
<script src="{{asset('backend/assets/vendors/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('backend/assets/js/tinymce.js')}}"></script>
<script src="{{asset('backend/assets/js/file-upload.js')}}"></script>
<script src="{{asset('backend/assets/vendors/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
{{-- <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> --}}


<script>
    setTimeout(function(){
         $('.alert').alert('close'); }, 3000);

    
</script>

<script>
    $(function() {
    'use strict';

    $("packageimageupload").dropzone({
        url: 'nobleui.com'
    });
});
</script>

{{-- // ckeditor --}}

<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor(
             plugins: [ Image, ImageResizeEditing, ImageResizeHandles]
        );
    });
</script>

<script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('upload_image_tinymce', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

    CKEDITOR.replace('short_description', {
        filebrowserUploadUrl: "{{route('upload_image_tinymce', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>






@endpush