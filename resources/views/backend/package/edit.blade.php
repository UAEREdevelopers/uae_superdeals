@extends('backend.layout.index')
@section('styles')

    <style>
        .mce-label.mce-charactercount {
            margin: 2px 0 2px 2px;
            padding: 8px;
            font-size: 12px;
        }


        .mce-path {
            display: none !important;
        }

    </style>

    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/dropzone/dropzone.min.css') }}">
@endsection
@section('content')
    <div class="page-content">

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-primary">Edit Package</h6>
                        <form action="{{ route('update_package') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="id" value="{{ $package->id }}">
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ $package->title }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Category</label>
                                        <select class="form-control" name="category_id" style="color: black">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if ($package->category_id == $category->id) selected @endif>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <h6 class="py-4 text-primary">Pricing</h6>

                                    <div class="form-group">
                                        <label class="control-label">Starting from Price</label>
                                        <input type="text" class="form-control" name="package_price"
                                            value="{{ $package->package_price }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Adult Price (AED)</label>
                                        <input type="number" step=".01" class="form-control" name="adult_price"
                                            value="{{ $package->adult_price }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Single Price (AED)</label>
                                        <input type="number" step=".01" class="form-control" name="single_price"
                                            value="{{ $package->single_price }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Child Price (6-11yrs) (AED)</label>
                                        <input type="number" step=".01" class="form-control" name="child_price_under_11"
                                            value="{{ $package->child_price_under_11 }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Child Price (2-5yrs) (AED)</label>
                                        <input type="number" step=".01" class="form-control" name="child_price_under_5"
                                            value="{{ $package->child_price_under_11 }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Infant Price (AED)</label>
                                        <input type="number" step=".01" class="form-control" name="infant_price"
                                            value="{{ $package->infant_price }}">
                                    </div>




                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" class="form-control" name="city" value="{{ $package->city }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <input type="text" class="form-control" name="country"
                                            value="{{ $package->country }}">
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ $package->banner_image }}" alt="" width="150" height="auto">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">

                                                <label>Banner image</label>
                                                <input type="file" name="bannerimage" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled=""
                                                        placeholder="file size (1920 x 800 px)">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-primary"
                                                            type="button">Replace</button>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ $package->mobile_banner_image }}" alt="" width="150" height="auto">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">

                                                <label>Mobile Banner image</label>
                                                <input type="file" name="mobilebannerimage" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled=""
                                                        placeholder="file size (400 x 600 px)">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-primary"
                                                            type="button">Replace</button>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                    <div class="row pt-4">
                                        <div class="col-md-4">
                                            <img src="{{ $package->thumbnail_image }}" alt="" width="150" height="auto">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Thumbnail image</label>
                                                <input type="file" name="thumbnail" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled=""
                                                        placeholder="file size (400 x267 px)">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-primary"
                                                            type="button">Replace</button>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <h6>Itinerary Details</h6>

                                    @php
                                        $itineraries = json_decode($package->itineraries);
                                        $itinerary_heading = json_decode($package->itinerary_heading);
                                        $days = $itineraries != null ? count($itineraries) : null;
                                        
                                    @endphp

                                    <div class="form-row">
                                        <div class="col">
                                            <label class="control-label">Days</label>
                                            <input type="text" class="form-control" name="itinerary_days"
                                                id="itinerary_days" value="{{ $days }}">
                                        </div>
                                        <div class="col pt-4">
                                            <button type="button" class="btn btn-primary make-days"
                                                onclick="makedays()">create Itinerary</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteAll()">Delete
                                                All</button>
                                        </div>
                                    </div>
                                    <div class="itineraries">
                                        @if ($days != null)

                                            @for ($i = 0; $i < $days; $i++)
                                                <h5 class="pt-4 pb-2">Day {{ $i + 1 }} </h5>
                                                <div class="form-group">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" class="form-control"
                                                        name="itinerary_heading[{{ $i }}]"
                                                        value="{{ $itinerary_heading[$i] ?? '' }}">
                                                </div>
                                                <div class="form-group pt-2" id="itinerary_{{ $i }}">
                                                    <label class="control-label">Description</label>
                                                    <!-- <button class="btn btn-danger pull-right px-4 py-2" onclick="deleteItinerary('itinerary_{{ $i }}')"> delete</button> -->
                                                    <textarea id="itinerary_area_{{ $i }}" type="text"
                                                        class="form-control" name="itinerary[{{ $i }}]"
                                                        rows="2">{{ $itineraries[$i] }}</textarea>
                                                </div>

                                            @endfor
                                        @endif
                                    </div>





                                </div>
                                <!-- Col -->
                                <div class="col-sm-8 col-md-8">
                                    <div class="form-group">
                                        <label class="control-label">Short Description</label>
                                        <textarea type="text" class="form-control" name="short_description"
                                            id="short_description" rows="5"
                                            maxlength="150">{!! $package->short_description !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea type="text" class="form-control" name="description" id="description"
                                            rows="5">{!! $package->description !!}</textarea>
                                    </div>
                                    <div class="form-group">
                           <label class="control-label">Tracking Code</label>
                           <textarea type="text" class="form-control" name="tracking_code"rows="5"  >{!! $package->tracking_code !!}</textarea>
                        </div>

                                </div>
                                <!-- Col -->
                            </div>
                            <!-- Row -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-lg package-btn submit">UPDATE PACKAGE</button>
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
                                <form action="{{ route('upload_hotel_image') }}" class="dropzone"
                                    id="package-image-upload">
                                    @csrf
                                    <input type="hidden" name="packageid" id="" value="{{ $package->id }}">
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    @endsection
    @push('scripts')
        <script src="{{ asset('backend/assets/vendors/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/tinymce.js') }}"></script>
        <script src="{{ asset('backend/assets/js/file-upload.js') }}"></script>
        <script src="{{ asset('backend/assets/vendors/dropzone/dropzone.min.js') }}"></script>

        <script>
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        </script>

        <script>
            var images = [];
            @if ($package->images)
                @foreach ($package->images as $image)
                    var image = { name: '{{ $image->name }}', link:'{{ $image->link }}',id:'{{ $image->id }}' , size:1234,
                    type: 'image/jpeg',accepted: true }
                    images.push(image);
                @endforeach
            
            @endif


            // drop zone test begins

             Dropzone.autoDiscover = false;
  
    var myDropzone = new Dropzone(".dropzone", { 
       maxFilesize: 10,
       acceptedFiles: ".jpeg,.jpg,.png",
       addRemoveLinks: true,
       removedfile: function(file) {
         var fileName = file.name; 
           
         $.ajax({
           type: 'POST',
           url: '{{ route("upload_hotel_image") }}',
           data: {"_token": "{{ csrf_token()}}",name: fileName, type: 'delete'},
           sucess: function(data){
              console.log('success: ' + data);
           }
         });
  
         var _ref;
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
       }
    });

     $.each(images, function(key,value) {
         var mockFile = { name: value.name, size: value.size, link:value.link };
         console.log(mockFile);
         myDropzone.emit("addedfile", mockFile);  
         myDropzone.files.push(mockFile); 
        // myDropzone.emit("thumbnail", mockFile, mockFile.link);
         myDropzone.options.thumbnail.call(myDropzone, mockFile, mockFile.link);
        // myDropzone.createThumbnailFromUrl(mockFile, mockFile.link);         
        myDropzone.emit("complete", mockFile);
        

     });
    
            // dropzone test ends


            // this is working.. dont touch 
            // Dropzone.options.packageImageUpload = {

            //     init: function() {

            //         // add existing files to dropzone
            //         let myDropzone = this;
            //         for (i = 0; i < images.length; i++) {
            //             console.log(images[i]);                        
            //             myDropzone.displayExistingFile(images[i], images[i]['link']);
            //             this.createThumbnailFromUrl(images[i], images[i]['link']);
            //             this.emit("complete", images[i]);
            //             this.files.push(images[i]);
            //         }

            //         this.on("addedfile", file => {
            //             console.log("A file has been added");
            //             // Create the remove button
            //             var removeButton = Dropzone.createElement(
            //                 "<button class='btn btn-danger pt-2' style='margin-top:4px;margin-left:20px;font-size:0.6rem'>Remove file</button>"
            //                 );

            //             // Capture the Dropzone instance as closure.
            //             var _this = this;
            //             // Listen to the click event
            //             removeButton.addEventListener("click", function(e) {
            //                 // Make sure the button click doesn't submit the form:
            //                 e.preventDefault();
            //                 e.stopPropagation();
            //                 console.log('Removed file');
            //                 console.log(file.xhr.response);
            //                 // Remove the file preview.
            //                 _this.removeFile(file);
            //                 // If you want to the delete the file on the server as well,
            //                 // you can do the AJAX request here.

            //                 $.ajax({
            //                     type: 'POST',
            //                     url: '{{ route('delete_package_image') }}',
            //                     data: {
            //                         "_token": "{{ csrf_token() }}",
            //                         name: file.xhr.response
            //                     },
            //                     sucess: function(data) {
            //                         console.log('success: ' + data);
            //                     }
            //                 });

            //             });

            //             // Add the button to the file preview element.
            //             file.previewElement.appendChild(removeButton);
            //         });
            //     }
            // }
        </script>
        <script>
            @for ($k = 0; $k < $days; $k++)
                var p = {{ $k }};
            
                if ($("#itinerary_area_"+p).length) {
                tinymce.init({
                selector: "#itinerary_area_"+p,
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
                toolbar1: 'insertfile undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify
                | bullist numlist outdent indent | link image',
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
            
            
            
            @endfor
        </script>

        <script>
            function makedays() {

                let days = $('#itinerary_days').val();
                for (let i = 0; i < days; i++) {

                    var html = `
            <h5 class="pt-4 pb-2">Day ` + parseInt(i + 1) + ` </h5>
        <div class="form-group">
                           <label class="control-label">Title</label>
                           <input type="text" class="form-control" name="itinerary_heading[` + i + `]" > 
                        </div>
            <div class="form-group pt-2" id="itinerary_` + i +
                        `">                
                <label class="control-label">Description</label> <!-- <button class="btn btn-danger pull-right px-4 py-2" onclick="deleteItinerary('itinerary_` + i + `')"> delete</button> -->
                <textarea id="itinerary_area_` + i + `" type="text" class="form-control selector" name="itinerary[` +
                        i + `]"  rows="2"  ></textarea>
            </div>
       `;

                    $('.itineraries').append(html);

                    if ($("#itinerary_area_" + i).length) {
                        tinymce.init({
                            selector: "#itinerary_area_" + i,
                            image_class_list: [{
                                title: 'img-fluid',
                                value: 'img-responsive'
                            }, ],
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
                                        cb(blobInfo.blobUri(), {
                                            title: file.name
                                        });
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


            function deleteItinerary(itinerary) {
                $('#' + itinerary).remove();
            }

            function deleteAll() {
                $('.itineraries').empty();
            }
        </script>



    @endpush
