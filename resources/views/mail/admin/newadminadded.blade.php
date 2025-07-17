<x-mail::message>
# New Admin added

Hello, we are pleased to inform you that a new admin named **{{ $admin->name }}** joined the team of Kenya Real Estate Portal Admins which you are part of.

<x-mail::button :url="route('admin.settings')">
view admins
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
