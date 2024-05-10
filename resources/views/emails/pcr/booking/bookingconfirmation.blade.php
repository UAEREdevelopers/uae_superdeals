@component('mail::message')
# Thank you for your Booking. 

Our team will contact you with more details regarting your PCR Testing.

# Booking Details:

Name: {{$package->name}} <br>
Email: {{$package->email}} <br>
Phone: {{$package->phone}} <br>
Date: {{$package->date}} <br>
Time: {{$package->time}} <br>
Place:{{$package->area}}, {{$package->city}} <br>
No.of Adults: {{$package->no_of_adults}}



Thanks,<br>
{{ config('app.name') }}
@endcomponent
