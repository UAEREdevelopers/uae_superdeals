@extends('backend.layout.index')

@section('content')

<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">HOTELRACK</a></li>
						<li class="breadcrumb-item active" aria-current="page">Hotels</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title"></h6>
                <p class="card-description"></p>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Star Rating</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($hotels as $hotel)

                      
                      <tr>
                          <td><img src="{{$hotel->Image}}" alt="" width="150px" height="auto"></td>
                        <td>{{$hotel->HCode}}</td>
                        <td>{{$hotel->HName}}</td>
                        <td>{{$hotel->city}} </td>
                        <td> {{$hotel->Country}}</td>
                        <td>{{$hotel->StarRating}}</td>
                        <td> <a href="#">Edit</a> </td>
                      </tr>

                      @endforeach                     
                    </tbody>
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

<script src="{{asset('backend/assets/js/data-table.js')}}"></script>

@endpush
