@component('mail::message', ['trip' => $trip ], ['user' => 'user'])
# {{ $user['email'] }} has invited you to collaborate

You have been invited to collaborate on trip {{ $trip['name'] }}. Follow the link below and enter the unique code to start collaborating.

@component('mail::button', ['url' => $url ])
Collaborate
@endcomponent

@component('mail::panel', ['invitate_code' => $invite_code ])
Invitation code: {{ $invite_code }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent