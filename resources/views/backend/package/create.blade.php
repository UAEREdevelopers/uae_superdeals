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
               <h5 class="card-title text-primary">Create Package</h5>
               <form action="{{route('save_package')}}" method="POST" enctype="multipart/form-data">
                @csrf

                  <div class="row">
                     <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                           <label class="control-label">Title</label>
                           <input type="text" class="form-control" name="title" required> 
                        </div>

                        <div class="form-group">
                           <label class="control-label">Category</label>
                               <select class="form-control" name="category_id"  style="color: black">
                                   <option value="" selected disabled>Select Category</option>
                                   @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                   @endforeach
                               </select>
                        </div>

                        <h6 class="py-4 text-primary">Pricing</h6>

                        <div class="form-group">
                           <label class="control-label">Starting from Price (AED)</label>
                           <input type="number" step=".01" class="form-control" name="package_price" > 
                        </div>

                        <div class="form-group">
                           <label class="control-label">Adult Price (AED)</label>
                           <input type="number" step=".01" class="form-control" name="adult_price" > 
                        </div>

                        <div class="form-group">
                           <label class="control-label">Single Price (AED)</label>
                           <input type="number" step=".01" class="form-control" name="single_price" > 
                        </div>

                        <div class="form-group">
                           <label class="control-label">Child Price (6-11yrs) (AED)</label>
                           <input type="number" step=".01" class="form-control" name="child_price_under_11" > 
                        </div>

                        <div class="form-group">
                           <label class="control-label">Child Price (2-5yrs) (AED)</label>
                           <input type="number" step=".01" class="form-control" name="child_price_under_5" > 
                        </div>

                        <div class="form-group">
                           <label class="control-label">Infant Price (AED)</label>
                           <input type="number" step=".01" class="form-control" name="infant_price" > 
                        </div>

                         <div class="form-group">
                           <label class="control-label">City</label>
                           <input type="text" class="form-control" name="city" > 
                        </div>
                        <div class="form-group">
                           <label class="control-label">Country</label>
                           <input type="text" class="form-control" name="country" > 
                        </div>

                        {{-- <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                           <label class="control-label">Adults</label>
                           <input type="text" class="form-control" name="no_of_adults" > 
                        </div>
                            </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                           <label class="control-label">Children</label>
                           <input type="text" class="form-control" name="no_of_children" > 
                        </div>
                             </div>
                        </div> --}}

                        <div class="form-group">
                        <label>Banner image</label>
                        <input type="file" name="bannerimage" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (1920 x 800 px)" required>
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>

                     <div class="form-group">
                         

                        <label>Mobile Banner image</label>
                        <input type="file" name="mobilebannerimage" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (400 x 600 px)" required>
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

                    <h6>Itinerary Details</h6>

                    <div class="form-row">
                        <div class="col">
                            <label class="control-label">Days</label>
                           <input type="text" class="form-control" name="itinerary_days" id="itinerary_days" > 
                        </div>
                        <div class="col pt-4">
                             <button type="button" class="btn btn-primary make-days" onclick="makedays()">create Itinerary</button>
                             <button type="button" class="btn btn-danger" onclick="deleteAll()">Delete All</button>
                        </div>
                    </div>
                    <div class="itineraries">

                    </div>
                        
                     </div>
                     <!-- Col -->
                     <div class="col-sm-8 col-md-8">
                        <div class="form-group">
                           <label class="control-label">Short Description</label>
                           <textarea type="text" class="form-control" name="short_description" id="short_description" rows="5"  maxlength="150"></textarea>
                        </div>
                        <div class="form-group">
                           <label class="control-label">Description</label>
                           <textarea type="text" class="form-control" name="description" id="description" rows="5"  ></textarea>
                        </div>

                        <div class="form-group">
                           <label class="control-label">Tracking Code</label>
                           <textarea type="text" class="form-control" name="tracking_code"rows="5"  ></textarea>
                        </div>


                     </div>
                     <!-- Col -->
                  </div>
                  <!-- Row -->
                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-success submit package-btn ">CREATE PACKAGE</button>
                  </div>
               
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
                            <form action="{{route('upload_hotel_image')}}" class="dropzone" id="package-image-upload">
                                @csrf
                            <input type="hidden" name="packageid" id="" value="{{$package_id}}">
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

<script>
    setTimeout(function(){
         $('.alert').alert('close'); }, 3000);    
</script>

<script>
Dropzone.options.packageImageUpload = {

        init: function() {
    this.on("addedfile", file => {
      console.log("A file has been added");
       // Create the remove button
        var removeButton = Dropzone.createElement("<button class='btn btn-danger pt-2' style='margin-top:4px;margin-left:20px;font-size:0.6rem'>Remove file</button>");

         // Capture the Dropzone instance as closure.
                var _this = this;
                 // Listen to the click event
                removeButton.addEventListener("click", function(e) {
                    // Make sure the button click doesn't submit the form:
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Removed file');
                    console.log(file.xhr.response);
                    // Remove the file preview.
                    _this.removeFile(file);
                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.

                    $.ajax({
                        type: 'POST',
                        url: '{{route("delete_package_image")}}',
                        data: {"_token": "{{ csrf_token() }}", name: file.xhr.response },
                        sucess: function(data){
                            console.log('success: ' + data);
                        }
                    });

                });

                 // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
    });
  }
}
</script>

<script>

    function makedays(){
       
       let days = $('#itinerary_days').val();
       for( let i = 0; i < days; i++ ){

        var html = `
        <h5 class="pt-4 pb-2">Day `+parseInt(i+1)+` </h5>
        <div class="form-group">
                           <label class="control-label">Title</label>
                           <input type="text" class="form-control" name="itinerary_heading[`+i+`]" > 
                        </div>
            <div class="form-group pt-2" id="itinerary_`+i+`">                
                <label class="control-label">Description</label> <!-- <button class="btn btn-danger pull-right px-4 py-2" onclick="deleteItinerary('itinerary_`+i+`')"> delete</button> -->
                <textarea id="itinerary_area_`+i+`" type="text" class="form-control selector" name="itinerary[`+i+`]"  rows="2"  ></textarea>
            </div>
       `;

       $('.itineraries').append(html);

       if ($("#itinerary_area_"+i).length) {
        tinymce.init({
            selector: "#itinerary_area_"+i,
            image_class_list: [
                { title: 'img-fluid', value: 'img-responsive' },
            ],
            height: 400,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
            },
            theme: 'silver',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
            ],
            toolbar: 'charactercount',
            toolbar1: 'insertfile undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/admin/upload',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            },
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: []
        });
    }


       }
       
    }


    function deleteItinerary(itinerary){
        $('#'+itinerary).remove();
    }

    function deleteAll(){
        $('.itineraries').empty();
    }
    
</script>





@endpush