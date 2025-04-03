<x-mail::message>
# Property Acquistion information submitted

This message was send to you to inform you that your information was
received successfully. If you did not submit any information please ignore.

<x-mail::button :url="url('/')">
Go to homepage
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
