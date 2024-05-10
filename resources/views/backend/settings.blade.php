@extends('backend.layout.index')


@section('styles')



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
                    <h6 class="card-title">Homepage Settings</h6>
                    <form action="{{route('admin_save_settings')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                     <div class="col-sm-8 col-md-8">
                        <div class="form-group">
                           <label class="control-label">Banner Title</label>
                           <input type="text" class="form-control" name="title" value="{{$settings->banner_heading ?? ''}}"> 
                        </div>
                        <div class="form-group">
                           <label class="control-label">Banner Text</label>
                           <input type="text" class="form-control" name="banner_text" value="{{$settings->banner_text ?? ''}}" > 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                 <img src="{{$settings->home_banner ?? ''}} " alt="" width="150" height="auto">
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                        <label>Banner image</label>
                        <input type="file" name="bannerimage" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (1600 x 450 px)" required>
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                 <img src="{{$settings->homepage_second_banner ?? ''}} " alt="" width="150" height="auto">
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                        <label>Hoempage Second Banner image</label>
                        <input type="file" name="homepage_second_banner" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (1600 x 450 px)" required>
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                 <img src="{{$settings->categories_banner ?? ''}} " alt="" width="150" height="auto">
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                        <label>Categories Banner image</label>
                        <input type="file" name="categories_banner" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="file size (1600 x 450 px)" required>
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                            </div>
                        </div>



                        

                         <h6 class="card-title mt-4">Homepage Categories</h6>

                         <div class="form-group">
                            <label for="exampleFormControlSelect1">Top Section</label>
                            <select class="form-control" name="top_section_category_id">
                                <option selected="" disabled="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if( $settings->top_section_category_id == $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Middle Section</label>
                            <select class="form-control" name="middle_section_category_id">
                                <option selected="" disabled="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if( $settings->middle_section_category_id == $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Bottom Section</label>
                            <select class="form-control" id="" name="bottom_section_category_id">
                               <option selected="" disabled="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if( $settings->bottom_section_category_id == $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        

                     <button type="submit" class="btn btn-primary submit">Save</button>
                     </div>
                        </div>
                  </form>
                     </div>
                    </div>
                </div>
            </div>
            
       
    </div>

@endsection


{{-- Custom scripts for current page --}}
@push('scripts')
<script src="{{asset('backend/assets/js/file-upload.js')}}"></script>

@endpush
