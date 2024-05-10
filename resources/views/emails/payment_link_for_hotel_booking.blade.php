@component('mail::message')
<h4>Thank you for your booking.</h4>

To receive your booking voucher please complete the payment. 

@component('mail::button', ['url' => route('payment_link',['id'=>$data['unique_id']])])
Pay Now
@endcomponent

<h5>Booking Details</h5>

<p>Hotel: <b>{{$data['hotelname']}} , {{$data['city']}}</b>  </p>
<p>Dates: <b>{{$data['dates']}}</b>  </p>
<p>Price: <b>{{$data['price']}} </b> </p>
<p>Guests: <b>{{$data['guests']}}</b>  </p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
