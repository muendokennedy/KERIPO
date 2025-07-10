<x-mail::message>
# Property Order Approved Message

This message is send to you **{{ $order->user->name}}** by the Kenya Real Estate Portal to inform you that the order you placed to acquire the property with ID of **{{ $order->property->propertyId}}** has been approved successfully. We will now continue to the next step of conducting a site tour and then make the stated payment for the property valuation.

Click on the link below to check the full details of your order and feel free to contact us.

<x-mail::button :url="route('admin.orderInfo',$order->id)">
View your order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
