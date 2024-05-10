@component('mail::message')
# Congrats!

Thank you for booking with Superdeals.ae.

# Booking Details

Confirmation No: <b>{{$data['bookingdetails']['ConfirmationNo'] ?? 'NA'}}

Status: {{$data['bookingdetails']['BookingStatus'] ?? 'Pending'}}

# Guest Details

@foreach( $data['guests']['value'] as $index => $guest)
{{$guest['value']['Title']['value'] }} {{ $guest['value']['FirstName']['value'] }} {{$guest['value']['LastName']['value'] }} , Age: {{ $guest['value']['Age']['value']  }} <br>
@endforeach

# Hotel Details

@php  
$roomdetails = json_decode($data['roomdetails']['roomdetails'], true);
@endphp

Hotel: {{$data['roomdetails']['HotelName']}}

Room: {{$roomdetails['RoomTypeName']}}

Price: {{$roomdetails['RoomRate']['PrefCurrency']}} {{$roomdetails['RoomRate']['PrefPrice'] }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
