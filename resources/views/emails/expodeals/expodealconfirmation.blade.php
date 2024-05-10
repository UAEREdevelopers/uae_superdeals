@component('mail::message')
# Congratulations!

You have successfully booked your staycation at {{$booking->hotel_selected}} for {{$booking->days_selected}} Nights. You will recieve your booking voucher shortly. 

Payment Status: {{$booking->payment_status}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent