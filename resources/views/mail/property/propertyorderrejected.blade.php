<x-mail::message>
# Property Order Rejected

Dear **{{$order->user->name}}** we are sad to inform you that the order **{{ $order->orderId }}** that you made in a bid to acquire a property with ID **{{ $order->property->propertyId }}** on **{{ $order->created_at }}** has been rejected.

You can read the message below to know the reason.

<div style="background-color: #f8f9fa; border-left: 4px solid #2DE19D; padding: 16px; margin-top: 10px; margin-bottom: 10px;">
    {!! nl2br(e($reason)) !!}
</div>

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
