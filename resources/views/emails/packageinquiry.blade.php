@component('mail::message')
# Thank you!

We have received your inquiry for the package {{$package->title}} . Our team will contact you shortly to assist you further. 

Thanks,<br>
{{ config('app.name') }}
@endcomponent
