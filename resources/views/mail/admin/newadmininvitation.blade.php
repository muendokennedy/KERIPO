<x-mail::message>
# Invitation for an Admin

Hello there we are pleased to inform that you have been invited to join our team of admins in the Kenya Real Estate Portal.

You have been invited by **{{ $admin->name }}** who is an admin in Kenya Real Estate Portal

You can click the button below to accept the invitation and create the esteemed admin account.

<x-mail::button :url="route('admin.register.show')">
Become an Admin
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
