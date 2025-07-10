<x-mail::message>
# Some Order Approved Message

@if(auth('admin')->id() === $admin->id)
This message is sent to you as an admin to confirm to you that you actually approved the order for the property with ID **{{ $order->property->propertyId}}** which was placed by **{{$order->user->name}}**
@else

This message is sent to you as an admin or Kenya Real Estate portal to inform you that the order for the property with ID of **{{ $order->property->propertyId}}** has been approved by **{{ $admin->name }}** who is also an admin.

You can contact contact them if there is any issues.

@endif




<x-mail::button :url="route('admin.orderInfo',$order->id)">
view order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
