<x-mail::message>
# Property Acquistion Approval message

This is message is sent to you as an admin of Kenya Real Estate portal to inform you that
a user **{{ $user->name }}** has successfully submitted data to acquired a property with propertyId **{{ $user->propertyId }}**.

Click the link below to approve or reject the acquisition order.                

<x-mail::button :url="route('admin.orders')">
Approve
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
