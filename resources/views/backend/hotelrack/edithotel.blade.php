@extends('backend.layout.index')
@section('styles')

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
               <h6 class="card-title">Edit Hotel</h6>
               <form action="{{route('update_hotel')}}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{$hotel->id}}">
                  <div class="row">
                     <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                           <label class="control-label">Hotel</label>
                           <input type="text" class="form-control" name="HName" value="{{$hotel->HName}}"> 
                        </div>
                        <div class="form-group">
                           <label class="control-label">City</label>
                           <input type="text" class="form-control" name="city" value="{{$hotel->city}}"> 
                        </div>
                        <div class="form-group">
                           <label class="control-label">Country</label>
                           <input type="text" class="form-control" name="Country" value="{{$hotel->Country}}"> 
                        </div>
                        <div class="col-sm-6 col-md-6">
                           <img src="{{$hotel->Image}}" alt="">
                        </div>
                     </div>
                     <!-- Col -->
                     <div class="col-sm-8 col-md-8">
                        <div class="form-group">
                           <label class="control-label">Address</label>
                           <textarea type="text" class="form-control" name="Address"  >{{$hotel->Address}}</textarea>
                        </div>
                        <div class="form-group">
                           <label class="control-label">Description</label>
                           <textarea type="text" class="form-control" name="Description" id="description" rows="10"  >{{$hotel->Description}}</textarea>
                        </div>
                     </div>
                     <!-- Col -->
                  </div>
                  <!-- Row -->
            
               <button type="submit" class="btn btn-primary submit">update</button>
                  </form>
            </div>
         </div>
      </div>
   </div>
   <div class="row py-2">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <div class="row ">
                  @forelse ($hotel->images as $image)
                      <div class="col-md-3">
                     <div class="card">
                        <img src="{{$image->link}}" alt="">
                        <div class="text-center">
                           <p> <a class="text-center" href="{{route('delete_image',['id'=> $image->id])}}" onclick="return confirm('Are you sure?')">Remove</a></p>
                        </div>
                     </div>
                  </div>
                  @empty
                      No images uploaded.
                  @endforelse
                  
               </div>
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
								<form action="{{route('upload_hotel_image')}}" class="dropzone" id="hotelimageupload">
                                    @csrf
                                <input type="hidden" name="id" id="" value="{{$hotel->id}}">
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
<script src="{{asset('backend/assets/vendors/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('backend/assets/js/dropzone.js')}}"></script>

<script>
    setTimeout(function(){
         $('.alert').alert('close'); }, 3000);

    
</script>
@endpush