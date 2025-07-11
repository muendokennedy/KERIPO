<x-mail::message>
# Please read the following message carefully

Dear **{{ $order->user->name }}**.

<div style="background-color: #f8f9fa; border-left: 4px solid #2DE19D; padding: 16px; margin-top: 10px; margin-bottom: 10px;">
    {!! nl2br(e($message)) !!}
</div>

Click the button below to view your order

<x-mail::button :url="route('admin.orderInfo', $order->id)">
view Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
