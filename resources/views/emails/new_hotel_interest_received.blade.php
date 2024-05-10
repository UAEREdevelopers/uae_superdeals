<h4>Guest Details</h4>

<p>Name: {{$data->name}}</p>
<p>Email: {{$data->email}}</p>
<p>Phone: {{$data->phone}}</p>

@php


$details = json_decode($data->details);
@endphp

<h4>Booking Details</h4>

<p>Hotel:{{$details->hotel_name}} </p>
<p>City: {{$details->city}}  </p>
<p> Dates : {{$details->booking_details->CheckInDate}} to {{$details->booking_details->CheckOutDate}} </p>
<p>Guests:  {{$details->booking_details->adults }}  Adults and {{$details->booking_details->children }} Children</p>
<p>Rooms : {{$details->no_of_rooms}} </p>
<p>Offer Price: AED {{$details->price_offered}} </p>

<h4>Room Details</h4>
@php

 $roomdetails =   json_decode($details->room_details, true );


@endphp

<p>Room Category : {{$roomdetails['RoomCategory'] ?? '' }} </p>
<p>Meal : {{$roomdetails['Meal'] ?? '' }}  </p>
<p>Price from API: AED  {{number_format($roomdetails['Amount'],0)}}   </p>


{{-- for prebook use below codes --}}

{{-- <p>Room Category : {{$roomdetails->RoomCategory }} </p> --}}
{{-- <p>Room Category : {{$roomdetails['RoomDetails'][0]['RoomCategory'] }} </p>
<p>Meal : {{$roomdetails['RoomDetails'][0]['Meal'] }}  </p>
<p>Available price: AED  {{$roomdetails['Amount']}}   </p> --}}