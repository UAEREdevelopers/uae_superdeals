@component('mail::message')
# Dear {{$invoice->name}},

Thank you for placing order with us. You will get notified once your order is dispatched.

@component('mail::table')
| Item    | Qty   | Price (AED)  |
|:------:   |:-----------   |:--------: |
@foreach($invoice->items as $item)
| {{$item->name}}     | {{$item->qty}} |        {{$item->price}} |
@endforeach
@endcomponent

@component('mail::panel')
    Total : AED {{number_format($invoice->price, 2)}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
