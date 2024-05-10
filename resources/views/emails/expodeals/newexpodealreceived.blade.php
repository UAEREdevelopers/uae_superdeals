@component('mail::message')
# Congratulations!

You have Received a new booking for Expo2020 Deals

Details:

Name: {{$booking->name }}
Phone: {{$booking->phone }}
Email: {{$booking->email }}
Hotel Selected: {{$booking->hotel_selected }}
Nights:  {{$booking->days_selected }}
Payment Status: {{$booking->payment_status }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent