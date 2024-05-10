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
                <h4>Edit booking</h4>

                <h5>Booking Details</h5>
                <a class="btn btn-primary" href="{{route('voucher_booking',['id'=>$booking->id])}}">Voucher booking</a>
                <a class="btn btn-primary" href="{{route('send_payment_link',['id'=>$booking->id])}}">Send Payment link</a>
                
                <h4>Price: AED {{$booking->price}} </h4>
                <h4>status: {{$booking->status}}</h4>
                <p>{{$booking->HotelName}} {{$booking->city}} {{$booking->city}} </p>
                <p>Dates: {{\Carbon\Carbon::parse($booking->checkInDate)->format('d-m-Y')}} to {{\Carbon\Carbon::parse($booking->checkOutDate)->format('d-m-Y')}} </p>
                <p>{{$booking->rooms}} Rooms : {{$booking->adults}}  Adults and {{$booking->children}}  children </p>
                

                <h5>Room Details</h5>

                @php $details = json_decode($booking->bookingDetails, true) ;
                    $details = json_decode( $details['roomdetails'], true) ;                 
                @endphp

                <p>Room: {{$details['RoomTypeName']}} </p>
                <p>Inclusion: {{$details['Inclusion']}}  </p>

                @if(isset( $details['Supplements']))

                <p>Suppliments</p>

                @foreach($details['Supplements'] as $suppliment)
                <p>{{$suppliment['CurrencyCode']}} {{$suppliment['Price']}}  {{$suppliment['SuppName']}}  {{$suppliment['SuppChargeType']}} {{$suppliment['Type']}}  </p>
                @endforeach

                @endif
                <p>Meal: {{$details['MealType']}} </p>
                <h6>Cancellation Policies</h6>
                <p>Last Cancellation Deadline: {{\Carbon\Carbon::parse($details['CancelPolicies']['LastCancellationDeadline'])->format('d-m-Y H:i')}}</p>
                <p>{{$details['CancelPolicies']['DefaultPolicy']}} </p>

                <p>Cancellatin charges: From  {{\Carbon\Carbon::parse($details['CancelPolicies']['CancelPolicy']['FromDate'])->format('d-m-Y')}}  To  {{\Carbon\Carbon::parse($details['CancelPolicies']['CancelPolicy']['ToDate'])->format('d-m-Y')}}  {{$details['CancelPolicies']['CancelPolicy']['CancellationCharge']}} {{$details['CancelPolicies']['CancelPolicy']['ChargeType'] == 'Percentage' ? '%' :  $details['CancelPolicies']['CancelPolicy']['Currency'] }}</p>

                <h6>Rate Distribution</h6>

                <table>
                    <tr>
                        <td>Price</td>
                        <td> {{$details['RoomRate']['PrefCurrency']}} {{$details['RoomRate']['PrefPrice']}} </td>
                        <td>Agent Markup</td>
                        <td> {{$details['RoomRate']['PrefCurrency']}} {{$details['RoomRate']['AgentMarkUp']}} </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


{{-- Custom scripts for current page --}}
@push('scripts')


@endpush
