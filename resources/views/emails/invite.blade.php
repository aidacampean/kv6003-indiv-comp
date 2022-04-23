@component('mail::message', ['trip' => $trip ], ['user' => 'user'])
# {{ $user['email'] }} has invited you to collaborate

You have been invited to collaborate on trip {{ $trip['name'] }}. Follow the link below and enter the unique code to start collaborating.

@component('mail::button', ['url' => $url ])
Collaborate
@endcomponent

@component('mail::panel', ['invite_code' => $invite_code ])
Invitation code: {{ $invite_code }}
@endcomponent

If you received this email in error, you can choose to ignore it or email aida.campean@northumbria.ac.uk for more information.

Thanks,<br>
{{ config('app.name') }}
@endcomponent