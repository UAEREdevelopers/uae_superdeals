@extends('backend.layout.index')

@section('content')

<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Room Inquiries</a></li>
						<li class="breadcrumb-item active" aria-current="page">By hotel</li>
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
                        <th>Name</th>
                        <th>Hotel</th>
                        <th>Dates</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($inquiries as $inquiry)

                      @php 
                      $bookingdetails = json_decode($inquiry->details);
                      $roomdetails =   json_decode($bookingdetails->room_details, true );
                      
                      @endphp
                      <tr>
                        <td>{{$inquiry->name}}</td>
                        <td>{{$bookingdetails->hotel_name ?? 'NA'}} , {{ $bookingdetails->city ?? 'NA'}}</td>
                        {{-- <td>{{$bookingdetails->booking_details->CheckInDate}} to {{$bookingdetails->booking_details->CheckOutDate }} </td> --}}
                        <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$bookingdetails->booking_details->CheckInDate)->format('d-m-Y')}} to {{\Carbon\Carbon::createFromFormat('Y-m-d',$bookingdetails->booking_details->CheckOutDate)->format('d-m-Y')}} </td>
                        <td> {{$bookingdetails->booking_details->adults }}  Adults and {{$bookingdetails->booking_details->children }} Children</td>
                        <td>{{$inquiry->status}}</td>
                        <td class="text-red">AED {{$bookingdetails->price_offered}} ( cost: AED {{$roomdetails['Amount']}} )  </td>
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
