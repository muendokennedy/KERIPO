<x-mail::message>
# New Admin added

@if(auth('admin')->id() === $admin->id)

Hello **{{ $admin->name }}** we are pleased to inform you that  you are now one of the team members of the Kenya Real Estate Portal Admin team
@else

Hello, we are pleased to inform you that a new admin named **{{ $admin->name }}** joined the team of Kenya Real Estate Portal Admins which you are part of.

@endif

<x-mail::button :url="route('admin.settings')">
view admins
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
