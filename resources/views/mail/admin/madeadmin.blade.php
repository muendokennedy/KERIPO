<x-mail::message>
# Made an Admin

Hello **{{ $admin->name }}** we are pleased to inform you that  you are now one of the team members of the Kenya Real Estate Portal Admin team


<x-mail::button :url="route('admin.settings')">
view admins
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
